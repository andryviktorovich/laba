<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListColor */

$this->title = 'Изменение цвета: ' . $model->color;
$this->params['breadcrumbs'][] = ['label' => 'Список цветов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->color, 'url' => ['view', 'id' => $model->id_color]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="list-color-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
