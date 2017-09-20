<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\base\Model;

/* @var $this yii\web\View */
/* @var $model app\models\Formula */

$this->title = $model->title . '(' . $model->id_mark . ')';
$this->params['breadcrumbs'][] = ['label' => 'Формулы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formula-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id_formula], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_formula], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '\'Вы уверены, что хотите удалить эту формулу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_formula',
            'id_mark',
            'title',
            'update_date',
            'create_date',
        ],
    ]) ?>

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

</div>
