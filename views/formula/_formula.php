<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use yii\grid\GridView;
use app\base\Model;

?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'showFooter' => true,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'id_formula',
        [
            'attribute'=>'id_material',
            'label' => 'Сырье',
            'format'=>'text', // Возможные варианты: raw, html
            'content'=>function($data){
                return  $data['material'];
            },
            'footer' => 'Итого'
        ],
        [
            'attribute'=>'percent',
            'label' => 'Процент (%)',
            'footer' => Model::getTotal($dataProvider->models, 'percent'),
        ],
        [
            'attribute'=>'cost',
            'label' => 'Цена сырья за 1 кг',
        ],
        [
            'attribute'=>'costM',
            'label' => 'Цена за 1 кг марки',
            'footer' => Model::getTotal($dataProvider->models, 'costM'),
        ],
        // 'update_date',
        // 'create_date',

//            ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>