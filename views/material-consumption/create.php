<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaterialConsumption */

$this->title = 'Добавление рассхода сырья';
$this->params['breadcrumbs'][] = ['label' => 'Остаток на складе', 'url' => ['in-stock']];
$this->params['breadcrumbs'][] = ['label' => 'Расход сырья', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-consumption-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'items' => $items,
    ]) ?>

</div>
