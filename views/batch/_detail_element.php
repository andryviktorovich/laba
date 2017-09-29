<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\material\Material;

/* @var $indexDetail integer */
/* @var $modelsElement app\models\BatchDetailElement */
/* @var $model app\models\Batch */

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-elements',
    'widgetItem' => '.elem-item',
    'limit' => 15,
    'min' => 0,
    'insertButton' => '.add-elem',
    'deleteButton' => '.remove-elem',
    'model' => $modelsElement[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'id_material',
        'percent',
    ],
]); ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th >Наименование</th>
                <th class="e-th-percent">Кол-во %</th>
<!--                <th>%</th>-->
<!--                <th>Коэф</th>-->
<!--                --><?php //for ($i = 0; $i < $model->count_bag; $i++): ?>
<!--                    <th>Замес --><?//= $i+1?><!--</th>-->
<!--                --><?php //endfor; ?>
                <th class="text-center e-th-action">
                    <button type="button" class="add-elem btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-elements">
        <?php foreach ($modelsElement as $indexElem => $modelElem): ?>
            <tr class="elem-item">
                <td class="vcenter" >
                    <?php
                    // necessary for update action.
                    if (! $modelElem->isNewRecord) {
                        echo Html::activeHiddenInput($modelElem, "[{$indexDetail}][{$indexElem}]id");
                    }
                    ?>
                    <?= $form->field($modelElem, "[{$indexDetail}][{$indexElem}]id_material")->dropDownList(Material::getListMaterials(),['prompt' => 'Выберите сырье...'])->label(false) ?>
                </td>
                <td class="vcenter e-td-percent">
                    <?= $form->field($modelElem, "[{$indexDetail}][{$indexElem}]percent")->textInput(['class' => 'e-percent form-control'])->label(false) ?>
                </td>
<!--                --><?php //if($indexElem == 0): ?>
<!--                    <td class="e-sum-percent" rowspan="--><?//= count($modelsElement)?><!--"></td>-->
<!--                --><?php //endif; ?>
<!--                <td></td>-->
<!--                --><?php //for ($i = 0; $i < $model->count_bag; $i++): ?>
<!--                    <td></td>-->
<!--                --><?php //endfor; ?>
                <td class="text-center vcenter e-td-action">
                    <button type="button" class="remove-elem btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
<?php DynamicFormWidget::end(); ?>