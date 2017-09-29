<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TaskstatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Taskstatuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taskstatus-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Taskstatus'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'uuid:ntext',
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
                'label' => '任务名',
                'value' => 'task.name',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'taskid', $searchModel->getTaskList() )
            ],
            'starttime',
            'endtime',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->getStatusList()
                )
            ],
            // 'outputtext:ntext',
            // 'outputfile',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
