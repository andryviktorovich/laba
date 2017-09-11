<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */

$this->title = $model->id_mark;
$this->params['breadcrumbs'][] = ['label' => 'Марки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id_mark], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id_mark], [
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
            'id_mark',
            [
                'attribute' => 'id_color',
                'value' => $model->color->color,
            ],
            [
                'attribute' => 'id_additive',
                'value' => $model->additive->additive,
            ],
            'heat_resistance',
            'light_fastness',
            'pigment_migration',
            [
                'attribute' => 'contact_with_food',
                'value' => $model->contact_with_food ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'norma_MFI',
                'value' => !empty($model->norma_MFI) ? $model->norma_MFI . '±5.0' : $model->norma_MFI,
            ],
            'conditions_MFI',
            [
                'attribute' => 'bulk_density',
                'value' => !empty($model->bulk_density) ? $model->bulk_density . '±0.1' : $model->bulk_density,
            ],
            'polymer_content',
            'base_polymer',
            'humidity',
            'description:ntext',
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
