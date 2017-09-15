<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleinfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articleinfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gch') ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'yearissue') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'taskid') ?>

    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'lngCollectIDs') ?>

    <?php // echo $form->field($model, 'keyword_e') ?>

    <?php // echo $form->field($model, 'author_e') ?>

    <?php // echo $form->field($model, 'imburse') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'media_c') ?>

    <?php // echo $form->field($model, 'num') ?>

    <?php // echo $form->field($model, 'lngid') ?>

    <?php // echo $form->field($model, 'pdfurl') ?>

    <?php // echo $form->field($model, 'beginpage') ?>

    <?php // echo $form->field($model, 'showorgan') ?>

    <?php // echo $form->field($model, 'pagecount') ?>

    <?php // echo $form->field($model, 'years') ?>

    <?php // echo $form->field($model, 'title_c') ?>

    <?php // echo $form->field($model, 'endpage') ?>

    <?php // echo $form->field($model, 'remark_c') ?>

    <?php // echo $form->field($model, 'keyword_c') ?>

    <?php // echo $form->field($model, 'title_e') ?>

    <?php // echo $form->field($model, 'media_e') ?>

    <?php // echo $form->field($model, 'showwriter') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'CoverPic') ?>

    <?php // echo $form->field($model, 'remark_e') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
