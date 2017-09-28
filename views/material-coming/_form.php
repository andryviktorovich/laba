<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\material\Material;
use app\models\Provider;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model app\models\MaterialComing */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="material-coming-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_material')->dropDownList(Material::getListMaterials(),['prompt' => 'Выберите материал']) ?>

    <?= $form->field($model, 'id_provider')->dropDownList(Provider::getListProviders(),['prompt' => 'Выберите поставщика']) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_coming')->widget(DateTimePicker::className(),[
//        'name' => 'dp_1',
//        'type' => DateTimePicker::TYPE_INPUT,
        'options' => ['placeholder' => 'Ввод даты'],
//        'removeButton' => false,
//        'convertFormat' => true,
//        'value'=> date("d.m.Y", strtotime($model->date_coming)),
        'pluginOptions' => [
            'minView' => 'month',
            'format' => 'yyyy-mm-dd',
            'autoclose'=>true,
            'todayHighlight' => true,
//            'weekStart'=>1, //неделя начинается с понедельника
            //'startDate' => '01.01.2000', //самая ранняя возможная дата
            'todayBtn'=>true, //снизу кнопка "сегодня"
        ]
    ]); ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'update_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>

    <?php if($model->isNewRecord): ?>
        <?= $form->field($model, 'create_date')->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
