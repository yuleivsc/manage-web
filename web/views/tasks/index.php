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
                //'label' => '年份',
                'attribute' => 'hostname',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'hostname', $searchModel->getHostnameList()
                )
            ],
            [
                'attribute' => 'username',
                'format' => 'raw',
                'filter' => Html::activeDropDownList($searchModel, 'hostname', $searchModel->getUsernameList()
                )
            ],
            'name',
            'descript',
            'command',
            'lasttime',
            // 'source:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
<?php Pjax::end(); ?></div>
