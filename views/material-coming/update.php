<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialComing */

$this->title = 'Изменение поставки сырья Id: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['/material-consumption/in-stock']];
$this->params['breadcrumbs'][] = ['label' => 'Поставки сыря', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Id поставки: ' . $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="material-coming-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
