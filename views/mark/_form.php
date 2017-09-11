<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ListColor;
use app\models\ListAdditive;
use app\models\ListPolymer;
use app\models\ListConditionsMFI;
/* @var $this yii\web\View */
/* @var $model app\models\Marks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_color')->dropDownList(ListColor::getListColor()) ?>

    <?= $form->field($model, 'id_additive')->dropDownList(ListAdditive::getListAdditive()) ?>

    <?= $form->field($model, 'heat_resistance')->textInput() ?>

    <?= $form->field($model, 'light_fastness')->dropDownList([0,1,2,3,4,5,6,7,8]); ?>

    <?= $form->field($model, 'pigment_migration')->dropDownList([0,1,2,3,4,5]); ?>

    <?= $form->field($model, 'contact_with_food')->checkbox(); ?>

    <?= $form->field($model, 'norma_MFI')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '9{0,4}[±5.0]',
    ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conditions_MFI')->dropDownList(ListConditionsMFI::getListConditionsMFI()) ?>

    <?= $form->field($model, 'bulk_density')->widget(\yii\widgets\MaskedInput::className(), [
        'mask' => '9{0,4}[±0.1]',
    ])->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'polymer_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'base_polymer')->dropDownList(ListPolymer::getListPolymer()) ?>

    <?= $form->field($model, 'humidity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'update_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'create_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
