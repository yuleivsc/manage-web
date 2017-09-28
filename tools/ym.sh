#!/bin/bash

YMANAGE_URL='http://manage.yulei.org/index.php?r=taskstatus/commit'

usage(){
    echo "Usage: $0 [options --] shell [argments]"
    echo '    options:'
    echo '      -h或--help 显示这个帮助'
    echo '      -v或--verbose 显示较多信息'
    echo '      -l logfile  命令行输出存储到logfile中'
    echo '      --syslog[=syslog]参数 命令行输出到系统日志中且为syslog加参数'
    exit 0
}

OPTPROC=`getopt -o hs::l:v --long help,syslog::,logfile:,verbose -- "$@"`

if [ $? != 0 ] ; then usage ;  fi

eval set -- "$OPTPROC"

fileout=0
syslogout=0
verbose='--silent'

while true ; do
    case "$1" in
        -v|--verbose)
            verbose=''
	    shift
            ;;
        -h|--help)
            usage
            ;;
        -l|--logfile)
            fileout=1
	    logfilename=$2
	    shift 2
            ;;
        --syslog)
            syslogout=1
	    case "$2" in
                "") syslogparam='' ; shift 2 ;;
                *)  syslogparam=$2 ; shift 2 ;;
            esac 
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

if [ $# == 0 ] ; then usage ;  fi

tempfile=`mktemp`

starttime=`date '+%F %T'`
cmdline="$*"
retcode="$1"
thepid=$$

tempstatus=`mktemp`
(eval $@; echo $? > $tempstatus) 2>&1 | while read line ;
do
	thetime=`date '+%F %T'`
	if [ $fileout = 1 ];
	then
		echo \[$thetime $thepid\] $line >> $logfilename
	fi
	if [ $syslogout = 1 ];
	then
		echo \[$thepid\] $line | logger $syslogparam
	fi
	echo \[$thetime $thepid\] $line  >> $tempfile
done

if [ `cat $tempstatus` = 0 ];
then
    status='OK'
else
    status='NG'
fi
endtime=`date '+%F %T'`

uuid=`uuid`
hostname=`hostname`
username=`id -un`
outputtext=`cat $tempfile`
#postparam="cmd=commit&uuid=$uuid&hostname=$hostname&username=$username&starttime=$starttime&endtime=$endtime&status=$status&retcode=$retcode"
postparam="uuid=$uuid&hostname=$hostname&username=$username&status=$status&retcode=$retcode"

curl $verbose -X "POST"  -d "cmd=commit" -d "$postparam" --data-urlencode "starttime=$starttime" --data-urlencode "endtime=$endtime" --data-urlencode "outputtext=$outputtext" --data-urlencode "command=$cmdline" $YMANAGE_URL  

rm $tempfile $tempstatus > /dev/null
