<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialComingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-coming-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_material') ?>

    <?= $form->field($model, 'id_provider') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'date_coming') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
