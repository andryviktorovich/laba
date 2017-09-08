<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListAdditive */

$this->title = 'Изменение добавки: ' . $model->additive;
$this->params['breadcrumbs'][] = ['label' => 'Список добавок', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->additive, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменение';
?>
<div class="list-additive-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
