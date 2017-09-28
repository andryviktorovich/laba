<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\material\MaterialInStock;
use app\models\Provider;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialInStock */
/* @var $dataProvider yii\data\SqlDataProvider */

$this->title = 'Остаток на складе';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="material-consumption-index">
    <div class="form-group">

        <?= Html::a('Список сырья', ['/material'], ['class' => 'btn btn-warning  ']) ?>
        <?= Html::a('Поставок сырья', ['/material-coming'], ['class' => 'btn btn-warning  ']) ?>
        <?= Html::a('Расходов сырья', ['/material-consumption'], ['class' => 'btn btn-warning  ']) ?>
    </div>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Добавить расход', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'beforeRow' => function ($model, $key, $index, $grid) use (&$currentBatch)
//        {
//            if($model['batch'] != $currentBatch) {
//                $currentBatch = $model['batch'];
//                return '<tr class="group-batch">
//                                <td  colspan=4>Партия: '.$model['batch'].'</td>
//                                    <td>
//                                        <a href="/material-consumption/update?id='. $model['batch']. '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
//                                        <a href="/material-consumption/delete?id='. $model['batch']. '" title="Удалить" aria-label="Удалить" data-pjax="0" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
//                                     </td>
//                                </tr>';
//            }
//        },
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id_material',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return  $data['material_title'];
                },
                'filter' => MaterialInStock::getInStock()
            ],
            [
                'attribute'=>'id_provider',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    return  $data['provider_name'];
                },
                'filter' => Provider::getListProviders()
            ],
            [
                'attribute'=>'amount',
                'contentOptions' =>function ($model){
                    if($model['amount']<0)
                        return ['class' => 'red'];
                    return [];
                },
            ],
            'cost',

//            'date_consumption',
            [
                'attribute' => 'date_coming',
                'value' => 'date_coming',
                'headerOptions' => ['width' => '200'],
//                'format' =>  ['date', 'dd.MM.Y'],
                'filter' => DateTimePicker::widget([
                    'model' => $searchModel,
                    'name' => 'MaterialInStock[date_coming]',
                    'value' => $searchModel->date_coming,
                    'pluginOptions' => [
                        'minView' => 'month',
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                        'todayBtn'=>true, //снизу кнопка "сегодня"
                        'todayHighlight' => true,
                    ]
                ])

            ],
            // 'update_date',
            // 'create_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
    <h3>Добавить рассход</h3>
    <?php  echo $this->render('_form', ['items' => $items, 'isStock' => true]); ?>
</div>