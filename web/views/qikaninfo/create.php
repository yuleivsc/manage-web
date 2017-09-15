<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Qikaninfo */

$this->title = Yii::t('app', 'Create Qikaninfo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qikaninfos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qikaninfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
