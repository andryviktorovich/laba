<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\datetime\DateTimePicker;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\WorkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Работы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-index">


<?php Pjax::begin(); ?>
    <?php
    $gridColumns = [
        [
            'class' => '\kartik\grid\ExpandRowColumn',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
//                $dataProvider = $model->searchElements();
                return 'hy!';//yii::$app->controller->renderPartial('/formula/_formula', ['dataProvider' => $dataProvider]);
            }
        ],

        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'date_work',
//            'width'=>'80px',
            'vAlign' => GridView::ALIGN_MIDDLE,
            'hAlign' => GridView::ALIGN_CENTER,
            'format' => 'raw',
            'filter' => DateTimePicker::widget([
                'model' => $searchModel,
                'name' => 'WorkSearch[date_work]',
                'value' => $searchModel->date_work,
                'pluginOptions' => [
                    'minView' => 'month',
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true,
                    'todayBtn'=>true, //снизу кнопка "сегодня"
                    'todayHighlight' => true,
                ]
            ])
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'id_machine',
            'value' => function ($model, $key, $index) {
                $machine = $model->machine;
                return $machine->title ?? '';
            },
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
            'filter' => \app\models\Machine::getListMachine()
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'operator',
            'value' => function ($model, $key, $index) {
                $operator = $model->operatorMachine;
                return $operator->getFIO();
            },
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
            'filter' => \app\models\Employees::getListEmployees()
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'shift',
            'vAlign'=> GridView::ALIGN_MIDDLE,
            'hAlign'=> GridView::ALIGN_CENTER,
            'format'=>'raw',
            'filter' => [1=>1, 2=>2]
        ],
    ];


    array_push($gridColumns, [
        'class' => 'kartik\grid\ActionColumn',
//            'dropdown' => true,
        'vAlign'=>'middle',
//            'template' => '{update} {delete} {choose}',
        'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{update}{delete}',
        'urlCreator' => function ($action, $model, $key, $index) {//
            return [$action, 'id' => $model->id ];
        },
    ]);

    echo GridView::widget([
        'id'=>'kv-grid',
        'dataProvider'=>$dataProvider,
        'filterModel' => $searchModel,
        'columns'=>$gridColumns,
        'resizableColumns'=>true,
        'toolbar' => [
            [
                'content'=> Html::a(Yii::t('app', 'Добавить'), ['create'], ['class' => 'btn btn-success']),
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
            'heading'=> 'Работы',
            //'before' => Html :: a ( '<i class = "glyphicon-plus"> </ i> Создать страну' , [ 'create' ], [ 'class' => 'btn btn-success' ]) ,
            //'after' => Html :: a ( '<i class = "glyphicon-repeat glyphicon-repeat"> </ i> Reset Grid' , [ 'index' ], [ 'class' => 'btn btn-info' ]) ,

//            'after' =>  $afterContent,
            'footer' => false,
        ],
    ]);
    ?>
<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'date_work',
//            'id_machine',
//            'operator',
//            'shift',
//            // 'plan_product',
//            // 'fact_product',
//            // 'update_date',
//            // 'create_date',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
<?php Pjax::end(); ?></div>
