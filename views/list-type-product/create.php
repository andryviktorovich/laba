<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ListTypeProduct */

$this->title = Yii::t('app', 'Добавление типа продукции');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список типов продукции'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-type-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
