<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Position;
use app\models\Employees;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Work */
/* @var $modelsTimetable app\models\Timetable */
/* @var $form yii\widgets\ActiveForm */

//$modelMachine = $model->machine;

?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'timetable_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.timetable-items', // required: css class selector
        'widgetItem' => '.timetable-item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsTimetable[0],
        'formId' => 'work-form',
        'formFields' => [
            'id_employee',
            'hours_operation',
            'id_position'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i><b>Табель</b>
            <div class="clearfix"></div>
        </div>
        <div class=""><!-- widgetContainer -->
            <table class="table table-bordered timetable-items">
                <thead>
                    <tr>
                        <th class="text-center t-employee">Сотрудник</th>
                        <th class="text-center t-hours">Часы работы</th>
                        <th class="text-center t-position">Должность</th>
                        <th class="text-center t-action">
                            <button type="button" class="add-item btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                        </th>
                    </tr>
                </thead>
                <?php foreach ($modelsTimetable as $index => $item): ?>

                    <tr class="timetable-item panel panel-default d-block-feeder">
                        <?php
                            if (!$item->isNewRecord) {
                                echo Html::activeHiddenInput($item, "[{$index}]id");
                            }
                        ?>
                        <td class="t-employee">
                            <?= $form->field($item, "[{$index}]id_employee")
                                ->dropDownList(Employees::getListEmployees(),['prompt' => 'Сотрудник'])
                                ->label(false) ?>
                        </td>
                        <td class="t-hours">
                            <?= $form->field($item, "[{$index}]hours_operation")
                                ->textInput(['class' => 'form-control'])
                                ->label(false) ?>
                        </td>
                        <td class="t-position">
                            <?= $form->field($item, "[{$index}]id_position")
                                ->dropDownList(Position::getListPosition(),['prompt' => 'Должность'])
                                ->label(false) ?>
                        </td>
                        <td class="text-center t-action">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>