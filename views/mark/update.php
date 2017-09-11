<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */

$this->title = 'Изменение марки: ' . $model->id_mark;
$this->params['breadcrumbs'][] = ['label' => 'Марки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_mark, 'url' => ['view', 'id' => $model->id_mark]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="marks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
