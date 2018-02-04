<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ListTypeProduct */

$this->title = Yii::t('app', 'Изменение {modelClass}: ', [
    'modelClass' => 'типа продукции',
]) . $model->type_product;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список типов продукции'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменение');
?>
<div class="list-type-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
