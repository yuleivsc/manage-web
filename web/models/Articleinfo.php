<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "articleinfo".
 *
 * @property integer $id
 * @property string $gch
 * @property string $year
 * @property string $yearissue
 * @property string $title
 * @property string $taskid
 * @property string $source
 * @property string $lngCollectIDs
 * @property string $keyword_e
 * @property string $author_e
 * @property string $imburse
 * @property string $class
 * @property string $media_c
 * @property string $num
 * @property string $lngid
 * @property string $pdfurl
 * @property string $beginpage
 * @property string $showorgan
 * @property string $pagecount
 * @property string $years
 * @property string $title_c
 * @property string $endpage
 * @property string $remark_c
 * @property string $keyword_c
 * @property string $title_e
 * @property string $media_e
 * @property string $showwriter
 * @property string $language
 * @property string $CoverPic
 * @property string $remark_e
 */
class Articleinfo extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'articleinfo';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'gch', 'taskid', 'source'], 'required'],
            [['id'], 'integer'],
            [['remark_c', 'remark_e'], 'string'],
            [['gch', 'taskid', 'source', 'lngCollectIDs', 'author_e', 'imburse', 'class', 'media_c', 'num', 'lngid', 'beginpage', 'pagecount', 'years', 'endpage', 'language', 'CoverPic'], 'string', 'max' => 256],
            [['year', 'yearissue'], 'string', 'max' => 11],
            [['title', 'pdfurl', 'showorgan', 'title_c', 'keyword_c', 'title_e', 'media_e', 'showwriter'], 'string', 'max' => 1024],
            [['keyword_e'], 'string', 'max' => 2048],
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
            'title' => Yii::t('app', '标题'),
            'taskid' => Yii::t('app', 'Taskid'),
            'source' => Yii::t('app', 'nssd或者ncpssd'),
            'lngCollectIDs' => Yii::t('app', 'Lng Collect Ids'),
            'keyword_e' => Yii::t('app', 'Keyword E'),
            'author_e' => Yii::t('app', 'Author E'),
            'imburse' => Yii::t('app', 'Imburse'),
            'class' => Yii::t('app', '学科分类'),
            'media_c' => Yii::t('app', '出版物'),
            'num' => Yii::t('app', 'Num'),
            'lngid' => Yii::t('app', 'Lngid'),
            'pdfurl' => Yii::t('app', 'Pdfurl'),
            'beginpage' => Yii::t('app', '开始页码'),
            'showorgan' => Yii::t('app', '作者机构'),
            'pagecount' => Yii::t('app', '页数'),
            'years' => Yii::t('app', 'Years'),
            'title_c' => Yii::t('app', 'Title C'),
            'endpage' => Yii::t('app', '结束页码'),
            'remark_c' => Yii::t('app', '简介'),
            'keyword_c' => Yii::t('app', '主题词'),
            'title_e' => Yii::t('app', 'Title E'),
            'media_e' => Yii::t('app', '出版物英文'),
            'showwriter' => Yii::t('app', '作者'),
            'language' => Yii::t('app', 'Language'),
            'CoverPic' => Yii::t('app', 'Cover Pic'),
            'remark_e' => Yii::t('app', 'Remark E'),
        ];
    }

    public function getQikaninfo() {
        return Qikaninfo::find()->where(['gch' => $this->gch]);
    }

}
