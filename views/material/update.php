<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Material */

$this->title = 'Изменение сырья: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['/material-consumption/in-stock']];
$this->params['breadcrumbs'][] = ['label' => 'Сырье', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="material-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
