<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Batch;
use app\models\MaterialInStock;
use kartik\datetime\DateTimePicker;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $items app\models\MaterialConsumption[] */

/* @var $form yii\widgets\ActiveForm */
$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Расход: " + (index + 1))
    });
    $(\'.datetimepicker\').datetimepicker(\'remove\');
     $(\'.datetimepicker\').datetimepicker({
        format: \'yyyy-mm-dd\',
        minView: \'month\',
        autoclose: true,
        todayHighlight: true,
        todayBtn: true,
        language: \'ru\',

    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Расход: " + (index + 1))
    });
});
';

$this->registerJs($js);
?>



<div class="material-consumption-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form',
                                     'action' => isset($isStock) ? ['material-consumption/create'] : '',
    ]); ?>


    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 15, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $items[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id_material_coming',
            'batch',
            'amount',
            'date_consumption',
            'update_date',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i>
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить рассход</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($items as $index => $item): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">Расход: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        // necessary for update action.
                        if (!$item->isNewRecord) {
                            echo Html::activeHiddenInput($item, "[{$index}]id");
                        }
                        ?>
                        <?= $form->field($item, "[{$index}]update_date")->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>
                        <?php if($item->isNewRecord): ?>
                            <?= $form->field($item, "[{$index}]create_date")->hiddenInput(['value' => date('Y-m-d h:i:s')])->label(false) ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($item,"[{$index}]id_material_coming")->dropDownList(MaterialInStock::getInStock(),['prompt' => 'Выберите сырье со склада']); ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($item,"[{$index}]batch")->dropDownList(Batch::getListBatches(),['prompt' => 'Выберите партию']) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($item,"[{$index}]amount") ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($item,"[{$index}]date_consumption")->widget(DateTimePicker::className(),[
                                    'options' => ['placeholder' => 'Ввод даты',
                                                    'class' => 'datetimepicker',
                                    ],
                                    'pluginOptions' => [
                                        'minView' => 'month',
                                        'format' => 'yyyy-mm-dd',
                                        'autoclose'=>true,
                                        'todayHighlight' => true,
                                        'todayBtn'=>true, //снизу кнопка "сегодня"
                                    ]
                                ]); ?>
                            </div>
                        </div><!-- .row -->

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($item->isNewRecord ? 'Сохранить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>
