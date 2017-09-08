<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Marks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_color')->textInput() ?>

    <?= $form->field($model, 'id_additive')->textInput() ?>

    <?= $form->field($model, 'heat_resistance')->textInput() ?>

    <?= $form->field($model, 'light_fastness')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pigment_migration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_with_food')->textInput() ?>

    <?= $form->field($model, 'norma_MFI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conditions_MFI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulk_density')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'polymer_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'base_polymer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'humidity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
