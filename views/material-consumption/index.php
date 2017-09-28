<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\material\Material;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialConsumptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Расход сырья';
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['in-stock']];
$this->params['breadcrumbs'][] = $this->title;

$currentBatch = null;
?>
<div class="material-consumption-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить расход', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'beforeRow' => function ($model, $key, $index, $grid) use (&$currentBatch)
            {
                if($model['batch'] != $currentBatch) {
                    $currentBatch = $model['batch'];
                    return '<tr class="group-batch">
                                <td  colspan=4>Партия: '.$model['batch'].'</td>
                                    <td>
                                        <a href="/material-consumption/update?id='. $model['batch']. '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="/material-consumption/delete?id='. $model['batch']. '" title="Удалить" aria-label="Удалить" data-pjax="0" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                                     </td>
                                </tr>';
                }
            },
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '80'],
            ],
            [
                'attribute'=>'material',
                'label' => 'Сырье',
                'format'=>'text', // Возможные варианты: raw, html
                'filter' => Material::getListMaterials()
            ],
            'amount',
//            'date_consumption',
            [
                'attribute' => 'date_consumption',
                'value' => 'date_consumption',
//                'format' =>  ['date', 'dd.MM.Y'],
                'filter' => DateTimePicker::widget([
                    'model' => $searchModel,
                    'name' => 'MaterialConsumptionSearch[date_consumption]',
                    'value' => $searchModel->date_consumption,
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
