<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $title
 * @property string $class
 * @property string $subclass
 * @property string $date
 * @property string $price
 * @property integer $no
 * @property integer $noend
 * @property integer $number
 * @property string $comment
 */
class Books extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'books';
    }

    public static function classList() {
        $list = array();
        $list['A'] = '工具书';
        $list['B'] = '哲学';
        $list['C'] = '历史';
        $list['D'] = '数理';
        $list['E'] = '计算机';
        $list['F'] = '文集';
        $list['G'] = '外语';
        return $list;
    }

    public static function subclassList($class) {
        $list = array();
        $list['A'] = array(
            'A1' => '百科',
            'A2' => '词典',
            'A3' => '专科',
            'A4' => '地图',
        );

        $list['B'] = array(
            'B21' => '中国哲学通论',
            'B22' => '古代中国哲学通论',
            'B23' => '现代中国哲学',
            'B31' => '西方哲学通论',
            'B32' => '西方古代哲学',
            'B33' => '西方中世纪哲学',
            'B34' => '西方近代哲学',
            'B4' => '印度哲学',
            'B5' => '哲学其他',
        );
        $list['C'] = array(
            'C21' => '世界史通论',
            'C22' => '中国史通论',
            'C221' => '中国史分类',
            'C222' => '中国史籍',
            'C23' => '亚洲史',
            'C24' => '欧洲史',
            'C25' => '美洲史',
            'C26' => '专业史',
            'C3' => '神话',
            'C4' => '文学',
            'C5' => '音乐',
            'C6' => '美术',
        );
        $list['D'] = array(
            'D1' => '数学',
            'D2' => '物理学',
            'D4' => '化学生物的',
            'D5' => '其他',
        );
        $list['E'] = array(
            'E' => '计算机',
        );
        $list['F'] = array(
            'F' => '文集',
        );
        $list['G'] = array(
            'G1' => '其他',
            'G2' => '英语',
            'G3' => '日语',
        );
        if ($class) {
            return array_merge($list[$class]);
        } else {
            return array_merge($list['A'], $list['B'], $list['C'], $list['D'], $list['E'], $list['F'], $list['G']);
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'comment'], 'required'],
            [['date'], 'safe'],
            [['price'], 'number'],
            [['no', 'noend', 'number'], 'integer'],
            [['title', 'comment'], 'string', 'max' => 512],
            [['class'], 'string', 'max' => 1],
            [['subclass'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '书名'),
            'class' => Yii::t('app', '大分类'),
            'subclass' => Yii::t('app', '小分类'),
            'date' => Yii::t('app', '购入日期'),
            'price' => Yii::t('app', '价格'),
            'no' => Yii::t('app', '编号'),
            'noend' => Yii::t('app', ''),
            'number' => Yii::t('app', '册数'),
            'comment' => Yii::t('app', '备注'),
        ];
    }

    /**
     * @inheritdoc
     * @return BooksQuery the active query used by this AR class.
     */
    public static function find() {
        return new BooksQuery(get_called_class());
    }

    public function getClassList() {
        $result = $this->find()->select('class')->distinct(true)->asArray()->all();
        $list[''] = '全部';
        $list['null'] = '无';
        $l = $this->classList();
        foreach ($l as $c => $s) {
            $list[$c] = $c . ':' . $s;
        }
        return $list;
    }

    public function getSubclassList($data) {

        $theclass = null;
        if ($data && key_exists('BooksSearch', $data)) {
            $param = $data['BooksSearch'];
            if (key_exists('class', $param)) {
                $theclass = $param['class'];
            }
        }
        $list = array('' => '全部');
        $list['null'] = '无';
        if ($theclass === 'null') {
            $l = $this->find()->select('subclass')->where(['class' => null])->distinct(true)->asArray()->all();
            foreach ($l as $c) {
                if ( $c ) {
                    $list[$c['subclass']] = $c['subclass'] ;
                }
            }
        } else {
            $l = $this->subclassList($theclass);
            foreach ($l as $c => $s) {
                $list[$c] = $c . ':' . $s;
            }
        }
        ksort($list);
        return $list;
    }

}
