<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Material;
use app\models\Marks;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Formula */
/* @var $form yii\widgets\ActiveForm */
$totalPercent = 0;
$totalCost = 0;

$js = '
function calculation(){
        var totalPercent = 0;
        var totalCost = 0;
        var cost;
        $(\'.dynamicform_wrapper .item\').each(function() {
            totalPercent += Number($(this).find(\'.formula-percent input\').val())
            cost = Number($(this).find(\'.formula-percent input\').val())/100*Number($(this).find(\'.formula-cost input\').val());
            $(this).find(\'.formula-cost-mark\').html(cost.toFixed(5));
            totalCost += cost;
        });
        if(totalPercent > 100) {
            $(\'.dynamicform_wrapper .formula-total .formula-percent\').addClass("red");
        } else {
            $(\'.dynamicform_wrapper .formula-total .formula-percent\').removeClass("red");
        }
        $(\'.dynamicform_wrapper .formula-total .formula-percent\').html(totalPercent.toFixed(2));
        $(\'.dynamicform_wrapper .formula-total .formula-cost-mark\').html(totalCost.toFixed(2));
}


$(\'.dynamicform_wrapper .item .formula-percent\').bind(\'keyup change blur\', function(){
    calculation();
});
$(\'.dynamicform_wrapper .item .formula-cost\').bind(\'keyup change blur\', function(){
    calculation();
});

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Расход: " + (index + 1))
    });

    $(item).find(\'.formula-cost-mark \').html("-")
    $(\'.container-items\').append($(\'.container-items .formula-total\'));
    $(\'.dynamicform_wrapper .item .formula-percent\').bind(\'keyup change blur\', function(){
        calculation();
    });
    $(\'.dynamicform_wrapper .item .formula-cost\').bind(\'keyup change blur\', function(){
        calculation();
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

<div class="formula-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($modelFormula, 'id_mark')->dropDownList(Marks::getListMarks(),['prompt' => 'Выберите марку']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelFormula, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="help-block"><?= $form->errorSummary($modelFormula);?></div>
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 15, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelFormulaElements[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id_material',
            'percent',
            'cost'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i>Формула
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить элемент</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body "><!-- widgetContainer -->
            <table class="table table-striped table-bordered container-items">
                <tr><th>Сырье</th><th>Процент (%)</th><th>Цена за 1 кг сырья</th><th>Цена за 1 кг марки</th><th></th></tr>
                <?php foreach ($modelFormulaElements as $index => $item): ?>
                    <tr class="item panel panel-default">
                        <?php
                        $totalPercent += (empty($item->percent)?0:$item->percent);
                        $cost = (empty($item->percent)?0:$item->percent)/100*(empty($item->cost)?0:$item->cost);
                        $totalCost += $cost;
                        // necessary for update action.
                        if (!$item->isNewRecord) {
                            echo Html::activeHiddenInput($item, "[{$index}]id");
                        }
                        ?>
                        <td>
                            <?= $form->field($item,"[{$index}]id_material")->dropDownList(Material::getListMaterials(),['prompt' => 'Выберите сырье'])->label(false); ?>
                        </td>
                        <td class="formula-percent"><?= $form->field($item,"[{$index}]percent")->label(false); ?></td>
                        <td class="formula-cost"><?= $form->field($item,"[{$index}]cost")->label(false); ?></td>
                        <td class="formula-cost-mark"><?= $cost ?></td>
                        <td>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        </td>

                    </tr>



                <?php endforeach; ?>
                <tr class="formula-total">
                    <td >Итого</td>
                    <td class="formula-percent <?= $totalPercent > 100 ? 'red': ''?>"><?= $totalPercent?></td>
                    <td class="formula-cost"></td>
                    <td class="formula-cost-mark"><?= $totalCost?></td>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group">
        <?= Html::submitButton($item->isNewRecord ? 'Добавить' : 'Изменить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>





