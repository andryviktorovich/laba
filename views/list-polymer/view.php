<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ListPolymer */

$this->title = $model->base_polymer;
$this->params['breadcrumbs'][] = ['label' => 'Список полимеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-polymer-view">

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
            'base_polymer',
            'melting_temperature',
        ],
    ]) ?>

</div>
