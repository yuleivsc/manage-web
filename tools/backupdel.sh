#!/bin/bash

#用于定时删除备份文件

file_dir=$1
file_template=$2
#file_template='*_backup.tar'

reserve_days=3  # 三天以内的备份文件不删除

stage1_days=30 # 阶段一：30天以内的文件 
stage1_inteval=5 # 阶段一：保留每隔5天的文件

#注：早于阶段一的文件，只保留每月1号的

if [ $# -ne 2 ];
then
	echo "Usage: $0 dir template"
	exit 1
fi

cd $file_dir

for file_name in `ls ${file_template} 2> /dev/null`
do
    file_unixtime=`stat -c %Z $file_name`
    unixtime=`date +%s`
    # 判断reserve_days天内的文件，如果在最近几天的，不删除
    if [ $((unixtime - file_unixtime)) -le  $((reserve_days*24*60*60)) ];
    then
#	    echo $((unixtime - file_unixtime)) 
#	    date -d @${file_unixtime}
#	    echo "1 not del $file_name"
	    continue
    fi
    # 判断stage1天内的文件
    if [ $((unixtime - file_unixtime)) -le  $((stage1_days*24*60*60)) ];
    then
	    file_day=`date -d @${file_unixtime} +%_d`
	    if [ $(( ( file_day - 1 ) % stage1_inteval)) -eq 0 ];
	    then
#	   	date -d @${file_unixtime}
#	        echo "2 not del $file_name"
	        continue
	    fi
    fi
    #余下的文件，判断是否是每月第一天的
    file_day=`date -d @${file_unixtime} +%_d`
    if [ $file_day -eq 1 ];
    then
#   	date -d @${file_unixtime}
#        echo "3 not del $file_name"
        continue
    fi
    echo rm -rf $file_name
    rm -rf $file_name
done 
