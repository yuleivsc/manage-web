<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\QikaninfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qikaninfo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gch') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'assoc') ?>

    <?= $form->field($model, 'classname') ?>

    <?php // echo $form->field($model, 'zbdw') ?>

    <?php // echo $form->field($model, 'zgdw') ?>

    <?php // echo $form->field($model, 'zb') ?>

    <?php // echo $form->field($model, 'cbzq') ?>

    <?php // echo $form->field($model, 'cksj') ?>

    <?php // echo $form->field($model, 'dj') ?>

    <?php // echo $form->field($model, 'gntykh') ?>

    <?php // echo $form->field($model, 'gjbzkh') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'intro') ?>

    <?php // echo $form->field($model, 'name_e') ?>

    <?php // echo $form->field($model, 'yfdh') ?>

    <?php // echo $form->field($model, 'updatetime') ?>

    <?php // echo $form->field($model, 'deleteflag') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
