<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ListAdditive */

$this->title = 'Создание добавки';
$this->params['breadcrumbs'][] = ['label' => 'Список добавок', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-additive-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
