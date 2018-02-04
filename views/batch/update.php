<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $modelsDetail app\models\BatchDetail */

$this->title = 'Изменения партии: ' . $model->batch;
$this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->batch, 'url' => ['view', 'id' => $model->batch]];
$this->params['breadcrumbs'][] = 'Изменение: ' .  $model->batch;
?>
<div class="batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailElement' => $modelsDetailElement
    ]) ?>

</div>
