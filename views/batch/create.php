<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $modelsDetail app\models\BatchDetail */

$this->title = 'Добавление партии';
$this->params['breadcrumbs'][] = ['label' => 'Партии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batch-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailElement' => $modelsDetailElement
    ]) ?>

</div>
