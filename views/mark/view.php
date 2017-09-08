<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */

$this->title = $model->id_mark;
$this->params['breadcrumbs'][] = ['label' => 'Marks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_mark], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_mark], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_mark',
            'id_color',
            'id_additive',
            'heat_resistance',
            'light_fastness',
            'pigment_migration',
            'contact_with_food',
            'norma_MFI',
            'conditions_MFI',
            'bulk_density',
            'polymer_content',
            'base_polymer',
            'humidity',
            'description:ntext',
            'update_date',
            'create_date',
        ],
    ]) ?>

</div>
