<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'class') ?>

    <?= $form->field($model, 'subclass') ?>

    <?= $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'no') ?>

    <?php // echo $form->field($model, 'noend') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'finddate') ?>

    <?php // echo $form->field($model, 'unnoflag') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
