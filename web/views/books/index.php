<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;

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
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'no',
                'format' => 'integer',
                'contentOptions' => [
                    'width' => '5%'
                ],
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'valueIfNull' => '<em></em>',
                ],
            ],
            [
                'attribute' => 'noend',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '5%'
                ],
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'valueIfNull' => '<em></em>',
                ],
            ],
            [
                'attribute' => 'title',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '30%'
                ],
                'class' => 'kartik\grid\EditableColumn',
            //'editableOptions' => [
            //    'asPopover' => false,
            //],
            ],
            [
                'attribute' => 'class',
                'format' => 'raw',
                'contentOptions' => [
                    'width' => '10%'
                ],
                'filter' => Html::activeDropDownList($searchModel, 'class', $searchModel->getClassList()),
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => $searchModel->getClassList(false),
                    'asPopover' => true,
                    'valueIfNull' => '<em></em>',
                //'pluginOptions' => [
                //    'prefix' => '$',
                //],
                ],
            ],
            [
                'attribute' => 'subclass',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'subclass', $searchModel->getSubclassList($params)),
                'contentOptions' => [
                    'width' => '10%'
                ],
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    'data' => $searchModel->getSubclassList($params, false),
                    'asPopover' => true,
                    'valueIfNull' => '<em></em>',
                ],
            ],
            [
                'attribute' => 'date',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '8%'
                ],
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_DATE,
                    //'asPopover' => false,
                    //这个设定我们组件的宽度
                    'contentOptions' => ['style' => 'width:180px'],
                    'options' => [
                        'pluginOptions' => [
                            //设定我们日期组件的格式
                            'format' => 'yyyy-mm-dd',
                        ],
                    ],
                    'valueIfNull' => '<em></em>',
                ],
            ],
            [
                'attribute' => 'price',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '5%'
                ],
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_MONEY,
                    'valueIfNull' => '<em></em>',
                //'pluginOptions' => [
                //    'prefix' => '$',
                //],
                ],
            ],
            [
                'attribute' => 'number',
                'format' => 'integer',
                'contentOptions' => [
                    'width' => '5%'
                ],
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_SPIN,
                    'pluginOptions' => [
                    //        'prefix' => '$',
                                         ],
                    'valueIfNull' => '<em></em>',
                ],
            ],
            [
                'attribute' => 'comment',
                'format' => 'text',
                'class' => 'kartik\grid\EditableColumn',
                'editableOptions' => [
                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                    'options' => [
                        'rows' => 4,
                        'valueIfNull' => '',
                    ],
                    'valueIfNull' => '<em></em>',
                ],
            ],
            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view} {update}',
            ],
        ],
    ]);
    ?>
</div>
