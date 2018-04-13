#!/bin/bash

YMANAGE_URL='http://manage.yulei.org/taskstatus/commit'
FILE_URL='https://raw.githubusercontent.com/yuleivsc/manage-web/master/tools/ym.sh'
FILE_VERSION='0.8.5'
FILE_DATE='$Date:2018-04-13T10:34:49+08:00$'

usage(){
    echo "Usage: $0 [options --] [shell [argments]"
    echo '    options:'
    echo '      -h或--help 显示这个帮助'
    echo '      -H或--hostname 设置主机名，而不是使用系统的主机名'
    echo '      -v或--verbose 显示较多信息'
    echo '      -l logfile  命令行输出存储到logfile中'
    echo '      --syslog[=syslog]参数 命令行输出到系统日志中且为syslog加参数'
    echo '      --version 显示当前版本，并且检查版本有无更新'
    echo '      -u或--upgrade 实施版本自动更新'
    echo '         当使用-h,--version,-u选项时，其他选项不起作用，并且不会实际执行shell命令'
    echo '         当使用-h,--version,-u不会执行shell命令'
    exit 0
}

version() {
    echo $FILE_VERSION  $FILE_DATE
    exit 0
}

upgrade() {
    tempshell=`mktemp`
    myshell=$0
    wget -q --no-cache -O $tempshell $FILE_URL > /dev/null
    #cp $myshell $tempshell
    diff -q $tempshell $myshell > /dev/null
    if [ $? == 1 ];
    then
       cmd="$tempshell --upgradeshell $myshell"
#       echo $cmd
       exec /bin/bash $tempshell --upgradeshell $myshell
    fi
    echo '无需更新程序'
    exit 0 
}

upgradeshell(){
    echo 'mcomment: 自动更新ym.sh自身'
    cmd="cp $0 $upgradeshell"
#    echo $cmd
    $cmd
    if [ $? == 0 ];
    then
	chmod 755 $upgradeshell > /dev/null
        echo "程序自动更新至版本 $FILE_VERSION ($FILE_DATE)"
	return 0
    else 
        echo "程序版本未能更新"
        return 1
    fi
}

OPTPROC=`getopt -o hs::l:vuH: --long help,syslog::,logfile:,upgrade,verbose,hostname:,version,upgradeshell:,tmpshell: -- "$@"`

if [ $? != 0 ] ; then usage ;  fi

eval set -- "$OPTPROC"

fileout=0
syslogout=0
verbose='--silent'
hostname=`hostname`
ifupgrade=0

while true ; do
    case "$1" in
        -v|--verbose)
            verbose=''
	    shift
            ;;
        -h|--help)
            usage
            ;;
        -u|--upgrade)
            upgrade
	    shift
            ;;
        -l|--logfile)
            fileout=1
	    logfilename=$2
	    shift 2
            ;;
        -H|--hostname)
	    hostname=$2
	    shift 2
            ;;
        --syslog)
            syslogout=1
	    case "$2" in
                "") syslogparam='' ; shift 2 ;;
                *)  syslogparam=$2 ; shift 2 ;;
            esac 
	    ;;
	--version)
	    version
	    ;;
        --upgradeshell)
            upgradeshell=$2
	    ifupgrade=1
	    shift 2
            ;;
	--) 
	    shift
	    break
	    ;;
	*) 
            usage
	    ;;
        esac
done

if [ $ifupgrade = 0 ];
then
    if [ $# == 0 ] ; then usage ;  fi
fi

tempfile=`mktemp`
tempdescript=`mktemp`
tempresult=`mktemp`

starttime=`date '+%F %T'`
cmdline="$*"
retcode="$1"
thepid=$$

tempstatus=`mktemp`

if [ ! $upgradeshell = "" ];
then
   cmdline=$upgradeshell
   retcode=$cmdline
   upgradeshell > $tempresult 2>&1
   echo $? > $tempstatus
   srccode=""
else
   (eval $@; echo $? > $tempstatus) > $tempresult 2>&1
   srccode=`cat $1`
fi

cat $tempresult | while read line ;
do
        if [ 'mcomment' == "${line:0:8}" ];
	then
	    descript=${line:9}
	    echo $descript > $tempdescript
	    continue
	fi
	thetime=`date '+%F %T'`
	if [ $fileout = 1 ];
	then
		echo [$thetime $thepid] $line >> $logfilename
	fi
	if [ $syslogout = 1 ];
	then
		echo [$thepid] $line | logger $syslogparam
	fi
	echo [$thetime $thepid] $line  >> $tempfile
done
descript=`cat $tempdescript`

if [ `cat $tempstatus` = 0 ];
then
    status='OK'
else
    status='NG'
fi
endtime=`date '+%F %T'`

uuid=`uuid`
username=`id -un`
outputtext=`cat $tempfile`
#postparam="cmd=commit&uuid=$uuid&hostname=$hostname&username=$username&starttime=$starttime&endtime=$endtime&status=$status&retcode=$retcode"
postparam="uuid=$uuid&hostname=$hostname&username=$username&status=$status&retcode=$retcode"

curl $verbose -X "POST"  -d "cmd=commit" -d "$postparam" --data-urlencode "starttime=$starttime" --data-urlencode "endtime=$endtime" --data-urlencode "outputtext=$outputtext" --data-urlencode "command=$cmdline" --data-urlencode "descript=$descript" --data-urlencode "srccode=$srccode" $YMANAGE_URL   > /dev/null

rm $tempfile $tempstatus $tempdescript $tempresult > /dev/null
