<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tasks'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'hostname',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'hostname', $searchModel->getHostnameList()
                )
            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'username', $searchModel->getUsernameList()
                )
            ],
            [
                //'class' => DataColumn::className(), // this line is optional
                'attribute' => 'name',
                'format' => 'raw',
                'filter' => true,
                'value' => function($data) {
                    //return Html::a(Html::encode($data->name), $url, $options);
                    return Html::a(Html::encode($data->name), ['/taskstatus', 'TaskstatusSearch[taskid]'=>$data->id]);
                }
            ],
            'descript',
            'command',
            [
                'attribute' => 'lasttime',
                'filter' => false,
            ],
            // 'source:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
