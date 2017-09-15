<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ArticleinfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articleinfos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articleinfo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'gch',
            [
                'label' => '期刊名',
                'value' => 'qikaninfo.name',
            ],
            [
                'attribute' => 'year',
                'filter' => false,
            ],
            [
                'attribute' => 'yearissue',
                'filter' => false,
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',
                'filter' => true,
                'value' => function($data) {
                    //return Html::a(Html::encode($data->name), $url, $options);
                   return Html::a(Html::encode($data->title),  
                                    'https://yulein.myqnapcloud.com:8081/pdfs/nssd/'.
                                    $data->gch .'-'.$data->qikaninfo->name.
                                    '/'.$data->year.'/'.$data->yearissue.'/'.
                                    $data->title.'.pdf'
                                , ['target' => 'pdfs']) ;
                }
            ],
            // 'taskid',
            // 'source',
            // 'lngCollectIDs',
            // 'keyword_e',
            // 'author_e',
            // 'imburse',
            // 'class',
            // 'media_c',
            // 'num',
            // 'lngid',
            // 'pdfurl:url',
            // 'beginpage',
            // 'showorgan',
            // 'pagecount',
            // 'years',
            // 'title_c',
            // 'endpage',
            //'class' => DataColumn::className(), // this line is optional
            [
                'attribute' => 'remark_c',
                'format' => 'text',
                'contentOptions' => [
                    'width' => '40%'
                ],
            ],
            'keyword_c',
            // 'title_e',
            // 'media_e',
            'showwriter',
            // 'language',
            // 'CoverPic',
            // 'remark_e:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
