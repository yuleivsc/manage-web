#!/bin/bash

YMANAGE_URL='http://manage.yulei.org/taskstatus/commit'
FILE_URL='https://raw.githubusercontent.com/yuleivsc/manage-web/master/tools/ym.sh'
FILE_VERSION='0.8.3'
FILE_DATE='$Date:2018-01-17T09:24:43+08:00$'

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
    rtn='mcomment: 自动更新ym.sh自己'
    wget -q -O $tempshell $FILE_URL
    diff -q $tempshell $myshell
    if [ $? == 1 ];
    then
       cmd="cp $tempshell $myshell"
       rtn=$rtn$cmt
       $cmd
       rtn=$rtn"版本更新至：$FILE_VERSION $FILE_DATE"
    fi
}

OPTPROC=`getopt -o hs::l:vuH: --long help,syslog::,logfile:,upgrade,verbose,hostname:,version -- "$@"`

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
            ifupgrade=1
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

if [ $ifupgrade == 1 ];
then
   cmdline='ym.sh'
   retcode=$cmdline
   upgrade > $tempresult
   echo 0 > $tempstatus
else
   (eval $@; echo $? > $tempstatus) 2>&1 > $tempresult
fi

echo $tempresult | while read line ;
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

curl $verbose -X "POST"  -d "cmd=commit" -d "$postparam" --data-urlencode "starttime=$starttime" --data-urlencode "endtime=$endtime" --data-urlencode "outputtext=$outputtext" --data-urlencode "command=$cmdline" --data-urlencode "descript=$descript" $YMANAGE_URL  

rm $tempfile $tempstatus $tempdescript > /dev/null
