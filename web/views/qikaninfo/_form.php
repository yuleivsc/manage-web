<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Qikaninfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qikaninfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'assoc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zbdw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zgdw')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zb')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cbzq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cksj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gntykh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gjbzkh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'intro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name_e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yfdh')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updatetime')->textInput() ?>

    <?= $form->field($model, 'deleteflag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
