<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "taskstatus".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $hostname
 * @property string $username
 * @property integer $taskid
 * @property string $command 
 * @property string $starttime
 * @property string $endtime
 * @property string $status
 * @property string $retcode
 * @property string $outputtext
 * @property string $outputfile
 * @property string $update_time 
 */
class Taskstatus extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'taskstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['uuid', 'outputtext'], 'string'],
            [['taskid'], 'integer'],
            [['starttime', 'endtime'], 'safe'],
            [['hostname', 'outputfile'], 'string', 'max' => 255],
            [['username', 'status'], 'string', 'max' => 32],
            [['command'], 'string', 'max' => 1024],
            [['retcode'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'uuid' => Yii::t('app', '此任务唯一ID，用于多次提交信息时辨认同一任务'),
            'hostname' => Yii::t('app', '主机名'),
            'username' => Yii::t('app', '用户名'),
            'taskid' => Yii::t('app', '任务id'),
            'command' => Yii::t('app', '执行命令'),
            'starttime' => Yii::t('app', '任务开始时间'),
            'endtime' => Yii::t('app', '任务结束时间'),
            'retcode' => Yii::t('app', '对方要求的字串'),
            'status' => Yii::t('app', '简短的结果标识'),
            'outputtext' => Yii::t('app', '执行结果'),
            'outputfile' => Yii::t('app', '结果文件如有'),
        ];
    }

    /**
     * @inheritdoc
     * @return TaskstatusQuery the active query used by this AR class.
     */
    public static function find() {
        return new TaskstatusQuery(get_called_class());
    }

}
