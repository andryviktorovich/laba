<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListPolymer */

$this->title = 'Изменение полимера: ' . $model->base_polymer;
$this->params['breadcrumbs'][] = ['label' => 'Список полимеров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->base_polymer, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="list-polymer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
