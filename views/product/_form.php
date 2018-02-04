<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_mark')->textInput() ?>

    <?= $form->field($model, 'type_product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_work')->textInput() ?>

    <?= $form->field($model, 'batch')->textInput() ?>

    <?= $form->field($model, 'finiched')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'starting')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cleaning')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'waste')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'update_date')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Добавить') : Yii::t('app', 'Изменить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
