<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Batch;
use app\models\Marks;
use app\models\listmodels\ListTypeProduct;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Work */
/* @var $modelsProduct app\models\Product */
/* @var $form yii\widgets\ActiveForm */

//$modelMachine = $model->machine;

?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'product_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.product-items', // required: css class selector
        'widgetItem' => '.product-item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsProduct[0],
        'formId' => 'work-form',
        'formFields' => [
            'waste',
            'type_product',
            'batch',
            'finiched',
            'reject',
            'starting',
            'cleaning',
            'waste',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i><b>Произведенный продукт</b>
            <div class="clearfix"></div>
        </div>
        <div class=""><!-- widgetContainer -->
            <table class="table table-bordered product-items">
                <thead>
                    <tr>
                        <th class="text-center p-mark">Марка</th>
                        <th class="text-center p-type_product">Тип продукции</th>
                        <th class="text-center p-batch">Партия</th>
                        <th class="text-center p-finiched">Готовая</th>
                        <th class="text-center p-reject">Брак</th>
                        <th class="text-center p-starting">Пусковые</th>
                        <th class="text-center p-cleaning">Чистка</th>
                        <th class="text-center p-waste">Отходы</th>
                        <th class="text-center p-action">
                            <button type="button" class="add-item btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                        </th>
                    </tr>
                </thead>
                <?php foreach ($modelsProduct as $index => $item): ?>

                    <tr class="product-item panel panel-default d-block-feeder">
                        <?php
                            if (!$item->isNewRecord) {
                                echo Html::activeHiddenInput($item, "[{$index}]id");
                            }
                        ?>
                        <td class="p-mark">
                            <?= $form->field($item, "[{$index}]id_mark")
                                ->dropDownList(Marks::getListMarks(),['prompt' => 'Марка'])
                                ->label(false) ?>
                        </td>
                        <td class="p-type_product">
                            <?= $form->field($item, "[{$index}]type_product")
                                ->dropDownList(ListTypeProduct::getListTypeProducts(),['prompt' => 'Тип продукции'])
                                ->label(false) ?>
                        </td>
                        <td class="p-batch">
                            <?= $form->field($item, "[{$index}]batch")
                                ->dropDownList(Batch::getListBatches(),['prompt' => 'Партия'])
                                ->label(false) ?>
                        </td>
                        <td class="p-finiched">
                            <?= $form->field($item, "[{$index}]finiched")
                                ->textInput(['class' => 'form-control', 'autocomplete' => 'off'])
                                ->label(false) ?>
                        </td>
                        <td class="p-reject">
                            <?= $form->field($item, "[{$index}]reject")
                                ->textInput(['class' => 'form-control', 'autocomplete' => 'off'])
                                ->label(false) ?>
                        </td>
                        <td class="p-starting">
                            <?= $form->field($item, "[{$index}]starting")
                                ->textInput(['class' => 'form-control', 'autocomplete' => 'off'])
                                ->label(false) ?>
                        </td>
                        <td class="p-cleaning">
                            <?= $form->field($item, "[{$index}]cleaning")
                                ->textInput(['class' => 'form-control', 'autocomplete' => 'off'])
                                ->label(false) ?>
                        </td>
                        <td class="p-waste">
                            <?= $form->field($item, "[{$index}]waste")
                                ->textInput(['class' => 'form-control', 'autocomplete' => 'off'])
                                ->label(false) ?>
                        </td>
                        <td class="text-center p-action">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>