<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "issue".
 *
 * @property integer $id
 * @property string $gch
 * @property string $year
 * @property string $yearissue
 * @property string $taskid
 * @property string $source
 * @property string $listscan
 * @property string $pdfscan
 */
class Issue extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'issue';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['gch', 'year', 'yearissue', 'taskid', 'source'], 'required'],
            [['gch', 'taskid', 'source', 'listscan', 'pdfscan'], 'string', 'max' => 256],
            [['year', 'yearissue'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'gch' => Yii::t('app', 'Gch'),
            'year' => Yii::t('app', '年份'),
            'yearissue' => Yii::t('app', '期'),
            'taskid' => Yii::t('app', 'Taskid'),
            'source' => Yii::t('app', 'nssd或者ncpssd'),
            'listscan' => Yii::t('app', 'Listscan'),
            'pdfscan' => Yii::t('app', 'Pdfscan'),
        ];
    }

    public function getQikaninfo() {
        return Qikaninfo::find()->where(['gch' => $this->gch]);
    }

    public function getYearList() {
        $result = $this->find()->select('year')->where(['gch' => $this->gch])->distinct(true)->asArray()->all();
        $list = array('' => '全部年份');
        foreach (array_values($result) as $y) {
            $list[$y['year']] = $y['year'];
        }
        arsort($list);
        return $list;
    }

    public function getArticleCount() {// TODO: 速度比较慢，先不用
        return Articleinfo::find()->where(['gch' => $this->gch, 'year'=>$this->year, 'yearissue'=>$this->yearissue])->count();
    }

}
