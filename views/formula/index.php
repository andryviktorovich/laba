<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\Marks;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FormulaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $batch app\models\Batch */
if($batch !== null) {
    $this->title = 'Выбор формулы';
    $this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
    $this->params['breadcrumbs'][] = ['label' => $batch->batch, 'url' => ['/batch/view', 'id' => $batch->batch]];

    $js = '

        var $grid = $(\'#kv-grid\');
        var selectFormula = ' . (!empty($batch->id_formula) ? $batch->id_formula : 0) . '
        $grid.on(\'grid.radiochecked\', function(ev, key, val) {
            selectFormula = val;
        });

        $grid.on(\'grid.radiocleared\', function(ev, key, val) {
            selectFormula = 0;
        });

        $(".select-formula").click(function(){
            $.post( "/batch/choose-formula?id=' . $batch->batch . '",
                    {
                        "Batch" : {"id_formula": Number(selectFormula)},
                        "' . \Yii:: $app->getRequest()->csrfParam . '" : "' . \Yii:: $app->getRequest()->getCsrfToken() . ' "
                    }
            );
        });
    ';
    $this->registerJs($js);

    $afterContent = Html::submitButton('Выбрать', ['class' => 'btn btn-success select-formula']);
} else {
    $this->title = 'Формулы';
    $afterContent = '';
}
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="formula-index">

    <?php
    $gridColumns = [
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
            'filter' => Marks::getListMarks()
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
    ];

    if($batch !== null){
        array_unshift($gridColumns, [
            'class' => '\kartik\grid\RadioColumn',
            'rowHighlight' => true,
            'name' => 'Batch[id_formula]',
            'radioOptions' => function ( $model , $key , $index , $column) use ($batch) {
                if($batch->id_formula == $model->id_formula){
                    return [ 'checked' => 'checked', 'value' => $model->id_formula ];
                }
                return [ 'value' => $model->id_formula];
            },
        ]);
    } else {
        array_push($gridColumns, [
            'class' => 'kartik\grid\ActionColumn',
//            'dropdown' => true,
            'vAlign'=>'middle',
//            'template' => '{update} {delete} {choose}',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => '{view}{update}{delete}{choose}',
            'urlCreator' => function ($action, $model, $key, $index) use ($batch) {//
                return [$action, 'id' => $model->id_formula , 'batch'=> $batch->batch ];
            },
        ]);
    }

    echo GridView::widget([
        'id'=>'kv-grid',
        'dataProvider'=>$dataProvider,
        'filterModel' => $searchModel,
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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['/formula/', 'batch'=> $batch->batch ], [
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
            'heading'=> ($batch !== null ? 'Выбор формулы для партии ' . $batch->batch : 'Список формул'),
            //'before' => Html :: a ( '<i class = "glyphicon-plus"> </ i> Создать страну' , [ 'create' ], [ 'class' => 'btn btn-success' ]) ,
            //'after' => Html :: a ( '<i class = "glyphicon-repeat glyphicon-repeat"> </ i> Reset Grid' , [ 'index' ], [ 'class' => 'btn btn-info' ]) ,

            'after' =>  $afterContent,
            'footer' => false,
        ],
    ]);
    ?>

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
<!--    --><?php //// echo $this->render('_search', ['model' => $searchModel]); ?>
<!---->
<!--    <p>-->
<!--        --><?//= Html::a('Добавить формулу', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
<?php //Pjax::begin(); ?><!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id_formula',
//            [
//                'attribute'=>'id_mark',
//                'format'=>'text', // Возможные варианты: raw, html
//                'filter' => Marks::getListMarks()
//            ],
//            'title',
////            'update_date',
////            'create_date',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>
<?php //Pjax::end(); ?>
</div>
