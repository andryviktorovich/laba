<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Batch;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\MaterialConsumption */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-consumption-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_material_coming')->textInput() ?>

    <?= $form->field($model, 'batch')->dropDownList(Batch::getListBatches()) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_consuption')->widget(DateTimePicker::className(),[
        'options' => ['placeholder' => 'Ввод даты'],
        'pluginOptions' => [
            'minView' => 'month',
            'format' => 'yyyy-mm-dd',
            'autoclose'=>true,
            'todayHighlight' => true,
            'todayBtn'=>true, //снизу кнопка "сегодня"
        ]
    ]); ?>

    <?= $form->field($model, 'update_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'create_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
