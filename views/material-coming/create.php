<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaterialComing */

$this->title = 'Добавление поставки сырья';
$this->params['breadcrumbs'][] = ['label' => 'Поставки сырья', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-coming-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
