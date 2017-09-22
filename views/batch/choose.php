<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Marks;
use app\models\FormulaSearch;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FormulaSearch */
/* @var $batch app\models\Batch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Выбор формулы';
$this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $batch->batch, 'url' => ['view', 'id' => $batch->batch]];
$this->params['breadcrumbs'][] = $this->title;


$js = '

';

$this->registerJs($js);

?>
<div class="formula-choose">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Добавить формулу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form = ActiveForm::begin(['id' => 'form-formula',]); ?>
    <?php
    $gridColumns = [
        [
            'class' => '\kartik\grid\RadioColumn',
            'rowHighlight' => true,
            'name' => 'Batch[id_formula]',
            'radioOptions' => function ( $model , $key , $index , $column) use ($batch) {
                    if($batch->id_formula == $model->id_formula){
                        return [ 'checked' => 'checked', 'value' => $model->id_formula ];
                    }
                    return [ 'value' => $model->id_formula];
            },
        ],
        [
            'class' => '\kartik\grid\ExpandRowColumn',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                $dataProvider = $model->searchElements();
                return yii::$app->controller->renderPartial('/formula/_formula', ['dataProvider' => $dataProvider]);
            }
        ],

        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'id_formula',
            'width'=>'80px',
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'id_mark',
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'title',
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'update_date',
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
        ],
//        [
//            'class' => 'kartik\grid\ActionColumn',
//            'dropdown' => true,
//            'vAlign'=>'middle',
//            'urlCreator' => function($action, $model, $key, $index) { return '#'; },
//            'viewOptions'=>['title'=>$viewMsg, 'data-toggle'=>'tooltip'],
//            'updateOptions'=>['title'=>$updateMsg, 'data-toggle'=>'tooltip'],
//            'deleteOptions'=>['title'=>$deleteMsg, 'data-toggle'=>'tooltip'],
//        ],
    ];

    echo GridView::widget([
        'id'=>'kv-grid',
        'dataProvider'=>$dataProvider,
        'columns'=>$gridColumns,
        'rowOptions'=>function($model) use ($batch){
            if($batch->id_formula == $model->id_formula){
                return ['class' => 'success'];
            }
        },
        'resizableColumns'=>true,
        'toolbar' => [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['/formula/create', 'batch'=> $batch->batch ], [
                        'class' => 'btn btn-success',
                        'title' => Yii::t('app', 'Добавить фомулу')
                    ]) . ' ' .
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['choose-formula', 'id'=> $batch->batch ], [
                        'class' => 'btn btn-default',
                        'title' => Yii::t('app', 'Обновить таблицу')
                    ]),
                'options' => ['class' => 'btn-group']
            ],
            '{toggleData}'
        ],

        'toggleDataContainer' => [ 'class' => 'btn-group' ],

        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'panel'=>[
            'type'=>GridView::TYPE_DEFAULT,
            'heading'=>'Формулы по марке ' . $batch->id_mark,
            //'before' => Html :: a ( '<i class = "glyphicon-plus"> </ i> Создать страну' , [ 'create' ], [ 'class' => 'btn btn-success' ]) ,
            //'after' => Html :: a ( '<i class = "glyphicon-repeat glyphicon-repeat"> </ i> Reset Grid' , [ 'index' ], [ 'class' => 'btn btn-info' ]) ,

            'after' =>  Html::submitButton('Выбрать', ['class' => 'btn btn-success']),
            'footer' => false,
        ],
]);
    ?>
    <?php ActiveForm::end(); ?>
</div>








