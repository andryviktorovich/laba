<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchDetail */

$this->title = Yii::t('app', 'Create Batch Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Batch Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batch-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
