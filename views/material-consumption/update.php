<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialConsumption */

$this->title = 'Изменение рассхода сырья на партию: ' . $batch;
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['in-stock']];
$this->params['breadcrumbs'][] = ['label' => 'Расход сырья', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="material-consumption-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'items' => $items,
        'batch' => $batch
    ]) ?>

</div>
