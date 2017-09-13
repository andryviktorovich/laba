<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Marks;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="batch-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'batch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_mark')->dropDownList(Marks::getListMarks(),['prompt' => 'Выберите марку']) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'release_date')->widget(DateTimePicker::className(),[
        'options' => ['placeholder' => 'Ввод даты'],
        'pluginOptions' => [
            'minView' => 'month',
            'format' => 'yyyy-mm-dd',
            'autoclose'=>true,
            'todayHighlight' => true,
            //'startDate' => '01.01.2000', //самая ранняя возможная дата
            'todayBtn'=>true, //снизу кнопка "сегодня"
        ]
    ]); ?>

    <?= $form->field($model, 'update_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'create_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
