<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '期刊列表');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qikaninfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?> 
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
            //'id',
            [
                //'class' => DataColumn::className(), // this line is optional
                'attribute' => 'name',
                'format' => 'raw',
                'filter' => true,
                'value' => function($data) {
                    //return Html::a(Html::encode($data->name), $url, $options);
                    return Html::a(Html::encode($data->name), ['/issue', 'IssueSearch[gch]'=>$data->gch]);
                }
            ],
            //'name',
            // 'assoc',
            [
                //'class' => DataColumn::className(), // this line is optional
                'attribute' => 'classname',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'classname', [
                    '' => '全部分类',
                    '哲学宗教' => '哲学宗教',
                    '社会学' => '社会学',
                    '政治法律' => '政治法律',
                    '经济管理' => '经济管理',
                    '文化科学' => '文化科学',
                    '语言文字' => '语言文字',
                    '文学' => '文学',
                    '艺术' => '艺术',
                    '历史地理' => '历史地理',
                    '自然科学总论' => '自然科学总论',
                        ]
                ),
                'value' => function($data) {
                    if (empty($data->classname)) {
                        return '不详';
                    }
                    return Html::a(Html::encode($data->classname), ['index', 'QikaninfoSearch[classname]' => $data->classname]);
                }
            ],
            [
                'attribute' => 'articleCount',
                'label' => '收录期数',
                'value' => 'issueCount',
            ],
            // 'zbdw',
            // 'zgdw',
            // 'zb',
            // 'cbzq',
            // 'cksj',
            // 'dj',
            // 'gntykh',
            // 'gjbzkh',
            // 'address',
            // 'price',
            [
                //'class' => DataColumn::className(), // this line is optional
                'attribute' => 'intro',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '60%'
                ],
            ],
            [
                //'class' => DataColumn::className(), // this line is optional
                'attribute' => 'gch',
                'filter' => false,
            ],
        // 'name_e',
        // 'yfdh',
        // 'updatetime',
        // 'deleteflag',
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
