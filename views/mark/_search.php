<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MarkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_mark') ?>

    <?= $form->field($model, 'id_color') ?>

    <?= $form->field($model, 'id_additive') ?>

    <?= $form->field($model, 'heat_resistance') ?>

    <?= $form->field($model, 'light_fastness') ?>

    <?php // echo $form->field($model, 'pigment_migration') ?>

    <?php // echo $form->field($model, 'contact_with_food') ?>

    <?php // echo $form->field($model, 'norma_MFI') ?>

    <?php // echo $form->field($model, 'conditions_MFI') ?>

    <?php // echo $form->field($model, 'bulk_density') ?>

    <?php // echo $form->field($model, 'polymer_content') ?>

    <?php // echo $form->field($model, 'base_polymer') ?>

    <?php // echo $form->field($model, 'humidity') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
