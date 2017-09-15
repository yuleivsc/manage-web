<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $name
 * @property string $descript
 * @property string $cmd
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
            [['descript', 'cmd'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '任务id'),
            'name' => Yii::t('app', '名称'),
            'descript' => Yii::t('app', '说明'),
            'cmd' => Yii::t('app', '执行命令'),
            'source' => Yii::t('app', '源代码'),
        ];
    }
}
