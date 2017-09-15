<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Issue */

$this->title = $model->qikaninfo->name .':'.$model->year.'年第'.$model->yearissue.'期';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Issues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="issue-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' =>'期刊名',
                'value' => $model->qikaninfo->name,
            ],
            'gch',
            'year',
            'yearissue',
            [           
                'label' => '收录数',
                'value' => $model->articleCount,
            ],
//            'taskid',
            'source',
//            'listscan',
//            'pdfscan',
            'id',
        ],
    ]) ?>

</div>
