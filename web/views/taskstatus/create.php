<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Taskstatus */

$this->title = Yii::t('app', 'Create Taskstatus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Taskstatuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="taskstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
