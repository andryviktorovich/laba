<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Material;
/* @var $this yii\web\View */
/* @var $model app\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'analog')->dropDownList(Material::getListMaterials(),['prompt' => 'Не задано']) ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

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
