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
            <th style="width: 250px;">Наименование</th>
            <th style="width: 100px;">Кол-во %</th>
            <th>%</th>
            <?php for ($i = 0; $i < $model->count_bag; $i++): ?>
                <th>Замес <?= $i+1?></th>
            <?php endfor; ?>
            <th class="text-center" style="width: 50px;">
                <button type="button" class="add-elem btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span></button>
            </th>
        </tr>
        </thead>
        <tbody class="container-elements">
        <?php foreach ($modelsElement as $indexElem => $modelElem): ?>
            <tr class="elem-item">
                <div class="help-block"><?= $form->errorSummary($modelElem);?></div>
                <td class="vcenter" style="width: 250px;">
                    <?php
                    // necessary for update action.
                    if (! $modelElem->isNewRecord) {
                        echo Html::activeHiddenInput($modelElem, "[{$indexDetail}][{$indexElem}]id");
                    }
                    ?>
                    <?= $form->field($modelElem, "[{$indexDetail}][{$indexElem}]id_material")->dropDownList(Material::getListMaterials(),['prompt' => 'Выберите сырье...'])->label(false) ?>
                </td>
                <td class="vcenter" style="width: 100px;">
                    <?= $form->field($modelElem, "[{$indexDetail}][{$indexElem}]percent")->label(false) ?>
                </td>
                <td></td>
                <?php for ($i = 0; $i < $model->count_bag; $i++): ?>
                    <td></td>
                <?php endfor; ?>
                <td class="text-center vcenter" style="width: 50px;">
                    <button type="button" class="remove-elem btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php DynamicFormWidget::end(); ?>