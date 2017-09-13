<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Material;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialConsumptionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Material Consumptions';
$this->params['breadcrumbs'][] = $this->title;

//$mat = new Material();
//print_r(Material::getInStock());
//exit();
$currentBatch = null;
?>
<div class="material-consumption-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Material Consumption', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'beforeRow' => function ($model, $key, $index, $grid) use (&$currentBatch)
            {
                if($model->batch != $currentBatch) {
                    $currentBatch = $model->batch;
                    return '<tr class="group-batch">
                                <td  colspan=4>Партия: '.$model->batch.'</td>
                                    <td>
                                        <a href="/material-consumption/update?id='. $model->batch. '" title="Редактировать" aria-label="Редактировать" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a>
                                        <a href="/material-consumption/delete?id='. $model->batch. '" title="Удалить" aria-label="Удалить" data-pjax="0" data-confirm="Вы уверены, что хотите удалить этот элемент?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                                     </td>
                                </tr>';
                }
            },
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_material_coming',
//            'batch',
            'amount',
            'date_consuption',
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
