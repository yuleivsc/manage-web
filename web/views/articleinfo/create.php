<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Articleinfo */

$this->title = Yii::t('app', 'Create Articleinfo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Articleinfos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articleinfo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
