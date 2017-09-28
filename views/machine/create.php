<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Machine */

$this->title = Yii::t('app', 'Create Machine');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
