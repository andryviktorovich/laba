<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_mark') ?>

    <?= $form->field($model, 'type_product') ?>

    <?= $form->field($model, 'id_work') ?>

    <?= $form->field($model, 'batch') ?>

    <?php // echo $form->field($model, 'finiched') ?>

    <?php // echo $form->field($model, 'reject') ?>

    <?php // echo $form->field($model, 'starting') ?>

    <?php // echo $form->field($model, 'cleaning') ?>

    <?php // echo $form->field($model, 'waste') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
