<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Batch */

$this->title = 'Изменения партии: ' . $model->batch;
$this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->batch, 'url' => ['view', 'id' => $model->batch]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>