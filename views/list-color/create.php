<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ListColor */

$this->title = 'Создание цвета';
$this->params['breadcrumbs'][] = ['label' => 'Список цветов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-color-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
