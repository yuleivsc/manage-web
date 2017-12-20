<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subclass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no')->textInput() ?>

    <?= $form->field($model, 'noend')->textInput() ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'finddate')->textInput() ?>

    <?= $form->field($model, 'unnoflag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
