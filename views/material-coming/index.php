<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Material;
use app\models\Provider;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MaterialComingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поставки материалов';
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['/material-consumption/in-stock']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-coming-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить поставку материала', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['width' => '80'],
            ],
            [
                'attribute'=>'id_material',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    $material = $data->material;
                    return $material ? $material->title : '';
                },
                'filter' => Material::getListMaterials()
            ],
            [
                'attribute'=>'id_provider',
                'format'=>'text', // Возможные варианты: raw, html
                'content'=>function($data){
                    $provider = $data->provider;
                    return $provider ? $provider->name : '';
                },
                'filter' => Provider::getListProviders()
            ],
            'amount',
            'cost',
            [
                'attribute' => 'date_coming',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            // 'remark:ntext',
            // 'update_date',
            // 'create_date',

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия',
                'headerOptions' => ['width' => '80'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
