<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $hostname
 * @property string $username
 * @property string $name
 * @property string $descript
 * @property string $command
 * @property string $lasttime
 * @property string $source
 */
class Tasks extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['lasttime'], 'safe'],
            [['source'], 'string'],
            [['hostname'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 50],
            [['type'], 'string', 'max' => 32],
            [['desthost'], 'string', 'max' => 255],
            [['descript', 'command'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', '任务id'),
            'hostname' => Yii::t('app', '主机名'),
            'username' => Yii::t('app', '用户名'),
            'name' => Yii::t('app', '名称'),
            'descript' => Yii::t('app', '说明'),
            'command' => Yii::t('app', '执行命令'),
            'type' => Yii::t('app', '类型'),
            'desthost' => Yii::t('app', '目标主机'),
            'lasttime' => Yii::t('app', '最后一次运行时间'),
            'source' => Yii::t('app', '源代码'),
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find() {
        return new TasksQuery(get_called_class());
    }

    public function getHostnameList() {
        $result = $this->find()->select('hostname')->distinct(true)->asArray()->all();
        $list = array('' => '全部');
        foreach (array_values($result) as $y) {
            $list[$y['hostname']] = $y['hostname'];
        }
        arsort($list);
        return $list;
    }

    public function getUsernameList() {
        $result = $this->find()->select('username')->distinct(true)->asArray()->all();
        $list = array('' => '全部');
        foreach (array_values($result) as $y) {
            $list[$y['username']] = $y['username'];
        }
        arsort($list);
        return $list;
    }

    public function getTypeList() {
        $result = $this->find()->select('type')->distinct(true)->asArray()->all();
        $list = array('' => '全部');
        foreach (array_values($result) as $y) {
            $list[$y['type']] = $y['type'];
        }
        arsort($list);
        return $list;
    }

    public function getDesthostList() {
        $result = $this->find()->select('desthost')->distinct(true)->asArray()->all();
        $list = array('' => '全部');
        foreach (array_values($result) as $y) {
            $list[$y['desthost']] = $y['desthost'];
        }
        arsort($list);
        return $list;
    }

}
