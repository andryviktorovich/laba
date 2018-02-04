<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */

$this->title = Yii::t('app', 'Изменение {modelClass}: ', [
    'modelClass' => 'сотрудника',
]) . $model->getFIO();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сотрудники'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменение');
?>
<div class="employees-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
