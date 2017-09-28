<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Marks;
use app\models\Machine;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $modelsDetail app\models\BatchDetail */
/* @var $modelsDetailElement app\models\BatchDetailElement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="batch-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="help-block"><?= $form->errorSummary($model);?></div>

    <?= $form->field($model, 'batch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_mark')->dropDownList(Marks::getListMarks(),['prompt' => 'Выберите марку']) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_machine')->dropDownList(Machine::getListMachine(),['prompt' => 'Выберите машину']) ?>

    <?= $form->field($model, 'date_start')->widget(DateTimePicker::className(),[
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


    <?= $form->field($model, 'count_bag')->textInput(['maxlength' => true]) ?>
    <?= $this->render('_detail', [
        'form' => $form,
        'model' => $model,
        'modelsDetail' => $modelsDetail,
        'modelsDetailElement' => $modelsDetailElement
    ]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
