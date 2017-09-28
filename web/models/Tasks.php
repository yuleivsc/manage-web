<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $name
 * @property string $hostname
 * @property string $descript
 * @property string $command
 * @property string $source
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['source'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['descript', 'command'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '任务id'),
            'hostname' => Yii::t('app', '主机名'),
            'name' => Yii::t('app', '名称'),
            'descript' => Yii::t('app', '说明'),
            'command' => Yii::t('app', '执行命令'),
            'source' => Yii::t('app', '源代码'),
            'lasttime' => Yii::t('app', '最后一次执行的时间'),
        ];
    }
}
