<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "qikaninfo".
 *
 * @property integer $id
 * @property string $gch
 * @property string $name
 * @property string $assoc
 * @property string $classname
 * @property string $zbdw
 * @property string $zgdw
 * @property string $zb
 * @property string $cbzq
 * @property string $cksj
 * @property string $dj
 * @property string $gntykh
 * @property string $gjbzkh
 * @property string $address
 * @property string $price
 * @property string $intro
 * @property string $name_e
 * @property string $yfdh
 * @property string $updatetime
 * @property integer $deleteflag
 */
class Qikaninfo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'qikaninfo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['gch'], 'required'],
            [['intro'], 'string'],
            [['updatetime'], 'safe'],
            [['deleteflag'], 'integer'],
            [['gch'], 'string', 'max' => 256],
            [['name', 'assoc'], 'string', 'max' => 1024],
            [['classname', 'cksj', 'dj', 'price'], 'string', 'max' => 20],
            [['zbdw', 'zgdw', 'zb'], 'string', 'max' => 100],
            [['cbzq', 'gntykh', 'gjbzkh', 'yfdh'], 'string', 'max' => 50],
            [['address', 'name_e'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'gch' => Yii::t('app', 'Gch'),
            'name' => Yii::t('app', 'Name'),
            'assoc' => Yii::t('app', 'Assoc'),
            'classname' => Yii::t('app', '分类'),
            'zbdw' => Yii::t('app', '主办单位'),
            'zgdw' => Yii::t('app', '主管单位'),
            'zb' => Yii::t('app', '主编'),
            'cbzq' => Yii::t('app', '出版周期'),
            'cksj' => Yii::t('app', '创刊时间'),
            'dj' => Yii::t('app', '单价'),
            'gntykh' => Yii::t('app', '国内统一刊号'),
            'gjbzkh' => Yii::t('app', '国际标准刊号'),
            'address' => Yii::t('app', '地址'),
            'price' => Yii::t('app', '总价'),
            'intro' => Yii::t('app', '简介'),
            'name_e' => Yii::t('app', '英文名'),
            'yfdh' => Yii::t('app', '邮发代号'),
            'updatetime' => Yii::t('app', 'Updatetime'),
            'deleteflag' => Yii::t('app', 'Deleteflag'),
        ];
    }

    public function getArticleCount() {// TODO: 速度比较慢，先不用
        return Articleinfo::find()->where(['gch' => $this->gch])->count();
    }
    public function getIssueCount() {
        return Issue::find()->where(['and', 'gch = \''.$this->gch.'\'','source = \'nssd\' '])->count();
    }

}
