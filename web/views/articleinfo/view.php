<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Articleinfo */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articleinfos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articleinfo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'gch',
            'year',
            'yearissue',
            'title',
            'taskid',
            'source',
            'lngCollectIDs',
            'keyword_e',
            'author_e',
            'imburse',
            'class',
            'media_c',
            'num',
            'lngid',
            'pdfurl:url',
            'beginpage',
            'showorgan',
            'pagecount',
            'years',
            'title_c',
            'endpage',
            'remark_c:ntext',
            'keyword_c',
            'title_e',
            'media_e',
            'showwriter',
            'language',
            'CoverPic',
            'remark_e:ntext',
        ],
    ]) ?>

</div>
