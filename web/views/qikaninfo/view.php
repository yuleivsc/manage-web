<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Qikaninfo */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', '期刊列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qikaninfo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>            
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'gch',
            'name',
            'intro:ntext',
            'classname',
            'zbdw',
            'zgdw',
            'zb',
            'cbzq',
            'cksj',
            'dj',
            'gntykh',
            'gjbzkh',
            'address',
            'price',
            'name_e',
            'yfdh',
            'assoc',
            'id',
            'updatetime',
            //'deleteflag',
        ],
    ]) ?>

</div>
