<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BatchDetailElement */

$this->title = Yii::t('app', 'Create Batch Detail Element');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Batch Detail Elements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batch-detail-element-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
