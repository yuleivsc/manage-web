<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Articleinfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articleinfo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'gch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yearissue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taskid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lngCollectIDs')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword_e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author_e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imburse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'media_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lngid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pdfurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'beginpage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'showorgan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pagecount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'years')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endpage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark_c')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'keyword_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'media_e')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'showwriter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CoverPic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark_e')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
