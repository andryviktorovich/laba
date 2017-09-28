<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\material\Material;
use app\models\Marks;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Batch */
/* @var $modelsDetail app\models\BatchDetail */
/* @var $modelsDetailElement app\models\BatchDetailElement */
/* @var $modelMachine app\models\Machine */
/* @var $form yii\widgets\ActiveForm */

//$modelMachine = $model->machine;

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper input.d-number-feeder").each(function(index) {
        jQuery(this).val((index + 1))
    });
    $(item).find(\'input.d-size-bag \').val(25);
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper input.d-number-feeder").each(function(index) {
        jQuery(this).val((index + 1))
    });
});
';

$this->registerJs($js);
?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 5, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsDetail[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'number_feeder',
            'size_bag'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i>Наряд

            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Добавить дозатор</button>
            <div class="clearfix"></div>
        </div>
        <div class=""><!-- widgetContainer -->
            <table class="table table-bordered container-items">
<!--                <tr><th></th><th></th></tr>-->
                <?php foreach ($modelsDetail as $index => $item): ?>

                    <tr class="item panel panel-default d-block-feeder">
                        <div class="help-block"><?= $form->errorSummary($item);?></div>
                        <?php

                        // necessary for update action.
                        if (!$item->isNewRecord) {
                            echo Html::activeHiddenInput($item, "[{$index}]id");
                        }
                        ?>
                        <td class="" width="120">
                            <?= $form->field($item,"[{$index}]number_feeder")->textInput(['class' => 'd-number-feeder form-control', 'value' => $index+1, 'readonly' => true]); ?>
                            <?= $form->field($item,"[{$index}]size_bag")->textInput(['class' => 'd-size-bag form-control']); ?>
                        </td>
                        <td class="d-block-elements">
                            <?= $this->render('_detail_element', [
                                'form' => $form,
                                'indexDetail' => $index,
                                'model' => $model,
                                'modelsElement' => $modelsDetailElement[$index],
//                                'modelsRoom' => $modelsRoom[$indexHouse],
                            ]) ?>
                        </td>
                        <td  style="width: 30px;">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
                        </td>
                    </tr>

                <?php endforeach; ?>


            </table>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>


