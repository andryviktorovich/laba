<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Batch;

/* @var $this yii\web\View */
/* @var $model app\models\MaterialConsumptionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-consumption-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'batch')->dropDownList(Batch::getListBatches(),['prompt' => 'Выберите партию']) ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
