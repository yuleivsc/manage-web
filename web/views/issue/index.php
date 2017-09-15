<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IssueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Issues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issue-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

    <p>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'gch',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{listalt}',
                //'template' => '{audit}',
                'buttons' => [
                    'listalt' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>',  
                                [
                                    '/articleinfo', 
                                    'ArticleinfoSearch[gch]'=>$model->gch,
                                    'ArticleinfoSearch[year]'=>$model->year,
                                    'ArticleinfoSearch[yearissue]'=>$model->yearissue,
                                ], ['title' => '阅读']) ;
                    },
                ],
            ],
            [
                'label' => '期刊名',
                'attribute' => 'qikaninfo.name',
            ],
            [
                'label' => '年份',
                'attribute' => 'year',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'year', $searchModel->getYearList()
                )
            ],
            [
                'label' => '期',
                'attribute' => 'yearissue',
                'filter' => false,
            ],
         [           
          'attribute' => 'articleCount',
          'label' => '文章数',
          'value' => 'articleCount',
          ], 
        //'taskid',
        // 'source',
        // 'listscan',
        // 'pdfscan',
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
