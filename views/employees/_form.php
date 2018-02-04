<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Position;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-6">
             <?= $form->field($model, 'position')->dropDownList(Position::getListPosition()) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'birth_day')->widget(DateTimePicker::className(),[
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

        </div>
    </div><!-- end:row -->

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>
        </div>
    </div><!-- end:row -->

<!--    --><?//= $form->field($model, 'head')->textInput() ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Изменить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
