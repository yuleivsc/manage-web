<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'no',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '5%'
                ],
            ],
            [
                'attribute' => 'noend',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '5%'
                ],
            ],
            [
                'attribute' => 'title',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '30%'
                ],
            ],
            [
                'attribute' => 'class',
                'format' => 'raw',
                'contentOptions' => [
                    'width' => '10%'
                ],
                'filter' => Html::activeDropDownList($searchModel, 'class', $searchModel->getClassList()),
            ],
            [
                'attribute' => 'subclass',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'subclass', $searchModel->getSubclassList($params)),
                'contentOptions' => [
                    'width' => '10%'
                ],
            ],
            [
                'attribute' => 'date',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '8%'
                ],
            ],
            [
                'attribute' => 'price',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '5%'
                ],
            ],
            [
                'attribute' => 'number',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '5%'
                ],
            ],
            'comment',
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update} {update-status}',
                'buttons' => [
                    'update-status' => function ($url, $model, $key) {
                        return Html::a('更新', 'javascript:;', ['onclick' => 'update_status(this, ' . $model->id . ');']);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>
