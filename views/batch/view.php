<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;


/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $modelFormula app\models\Formula */

$this->title = $model->batch;
$this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="batch-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->batch], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->batch], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'batch',
            'id_mark',
            'amount',
            'cost',
            [
                'attribute' => 'id_machine',
                'value' => $model->machine->title,
            ],
            [
                'attribute' => 'date_start',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            [
                'attribute' => 'release_date',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            [
                'attribute' => 'update_date',
                'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
            ],
            [
                'attribute' => 'create_date',
                'format' =>  ['date', 'HH:mm:ss dd.MM.Y'],
            ],
        ],
    ]) ?>

    <?php
    $items = [
        [
            'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Наряд на партию',
            'content' =>  $this->render('view_detail', [
                'model' => $model,
                'modelFormula' => $modelFormula,
            ]),
            'active'=>true
        ],
        [
            'label'=>'<i class="glyphicon glyphicon-th-list"></i> Формула',
            'content'=> $this->render('_formula', [
                'model' => $model,
                'modelFormula' => $modelFormula,
            ]),
        ],
    ];
    echo TabsX::widget([
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'bordered'=>true,
        'encodeLabels'=>false
    ]);
    ?>


</div>
