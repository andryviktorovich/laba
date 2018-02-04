<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Machine;
use app\models\Employees;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Work */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsTimetable app\models\Timetable */
/* @var $modelsProduct app\models\Product */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(['id' => 'work-form']); ?>

    <div class="help-block"><?= $form->errorSummary($modelsTimetable);?></div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'date_work')->widget(DateTimePicker::className(),[
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

            <?= $form->field($model, 'id_machine')->dropDownList(Machine::getListMachine(),['prompt' => 'Выберите машину']) ?>

            <?= $form->field($model, 'operator')->dropDownList(Employees::getListEmployees(),['prompt' => 'Выберите оператора']) ?>

            <?= $form->field($model, 'shift')->dropDownList([1 => 1, 2 => 2],['prompt' => 'Выберите смену']) ?>

            <?= $form->field($model, 'plan_product')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fact_product')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-6">
            <?= $this->render('_form_timetable', [
                'form' => $form,
                'model' => $model,
                'modelsTimetable' => $modelsTimetable
            ]) ?>

        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-12">
            <?= $this->render('_form_product', [
                'form' => $form,
                'model' => $model,
                'modelsProduct' => $modelsProduct
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
