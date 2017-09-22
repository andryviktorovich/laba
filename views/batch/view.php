<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Batch */

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

    <?php if($model->id_formula == null): ?>
        <h3>Формула не задана!</h3>
        <p>
            <?= Html::a('Выбрать формулу', ['choose-formula', 'id' => $model->batch], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php else: ?>
        <p>
            <?= Html::a('Выбрать другую формулу', ['choose-formula', 'id' => $model->batch], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Редактировать формулу', ['/formula/update', 'id' => $model->id_formula, 'batch' => $model->batch], ['class' => 'btn btn-primary']) ?>
        </p>
        <?= $this->render('/formula/_formula', [
            'dataProvider' => $dataProvider,
        ]) ?>
    <?php endif; ?>
</div>
