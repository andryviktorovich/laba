<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Work */

$title = $model->date_work . ' (' . $model->shift . ' см.)';
$this->title = Yii::t('app', 'Изменение {modelClass}: ', [
    'modelClass' => 'работы',
]) . $title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Работы'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Изменение') . ': ' . $title;
?>
<div class="work-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsTimetable' => $modelsTimetable,
        'modelsProduct' => $modelsProduct,
    ]) ?>

</div>
