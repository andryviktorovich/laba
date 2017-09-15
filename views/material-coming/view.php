<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialComing */

$this->title = 'Id поставки: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['/material-consumption/in-stock']];
$this->params['breadcrumbs'][] = ['label' => 'Поставки сырья', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-coming-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
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
            'id',
            [
                'attribute' => 'id_material',
                'value' => $model->material->title,
            ],
            [
                'attribute' => 'id_provider',
                'value' => $model->provider->name,
            ],
            'amount',
            'cost',
            [
                'attribute' => 'date_coming',
                'format' =>  ['date', 'dd.MM.Y'],
            ],
            'remark:ntext',
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

</div>
