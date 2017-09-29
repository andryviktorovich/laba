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

?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.detail-item', // required: css class
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

                    <tr class="detail-item panel panel-default d-block-feeder">
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
                <tr class="d-total">
                    <td >Итого</td>
                    <td class="d-total-data">
                        <table class="table table-bordered">
<!--                            <thead>-->
<!--                                <tr>-->
<!--                                    <th style="width: 250px;">Наименование</th>-->
<!--                                    <th style="width: 100px;">Кол-во %</th>-->
<!--                                    <th>%</th>-->
<!--                                    <th>Коэф</th>-->
<!--                                    --><?php //for ($i = 0; $i < $model->count_bag; $i++): ?>
<!--                                        <th>Замес --><?//= $i+1?><!--</th>-->
<!--                                    --><?php //endfor; ?>
<!--                                    <th class="text-center" style="width: 50px;">-->
<!--                                    </th>-->
<!--                                </tr>-->
<!--                            </thead>-->
                            <tr>
                                <td class="vcenter"></td>
                                <td class="vcenter d-total-percent"></td>
                                <td class="d-total-action"></td>
                            </tr>
                        </table>
                    </td>
                    <td></td>
                </tr>

            </table>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>


<?php
$js = '

// Поиск и добавление ячейки с суммой процентов по дозатору
function sumPercent(){
    var countBag = Number($("#d-count-bag").val());
    var amount = Number($("#d-amount").val());
    var totalPercent = 0;
    $(".temporarily").remove();

    jQuery(".detail-item").each(function(index) {
        var sumPercent = 0;
        var maxPercent = 0;
        var sizeBag = Number($(this).find(".d-size-bag").val());
        var mas = []
        for (var i = 0; i < countBag; i++) {
            mas[i] = 0;
        }
        $(this).find("input.e-percent ").each(function(){
            sumPercent += Number($(this).val());
            if(Number($(this).val()) > maxPercent){
                maxPercent = Number($(this).val());
            }
        });
        var koefMain = maxPercent == 0 ? 0 : sizeBag/maxPercent;

        $(this).find(".elem-item").each(function(){
            html = "";
            percent = Number($(this).find("input.e-percent").val());
            koef = (percent != maxPercent ? koefMain*percent : (percent != 0 ? sizeBag : "" ) )
            for (var i = 1; i <= countBag; i++) {
                mas[i-1] += (koef*i);
                if(percent != maxPercent){
                    html += "<td class=\'temporarily\'>" + (koef*i).toFixed(4) + "</td>";
                } else {
                    html += "<td class=\'temporarily\'><u>" + (koef*i).toFixed(4) + "</u></td>";
                }
            }
            $(this).find(".e-td-action").before(html);
        });

        ///формирование заголовка и итогов таблицы с элементами
        html = "";
        html2 = "";
        for (var i = 1; i <= countBag; i++) {
                html += "<th class=\'temporarily\'>(" + (i) + ")</th>";
                if(sumPercent != 0){
                    val = (mas[i-1]).toFixed(2) + "кг (" + (amount/(mas[i-1]/(sumPercent/100))).toFixed(2) + " замесов)"
                } else {
                    val = "-";
                }
                html2 += "<td class=\'temporarily\'>" + val + "</td>"
        }
        $(this).find(".e-th-action").before(html);

        $(this).find(".container-elements").append("\
            <tr class=\'e-total temporarily\'>\
                <td>Итого по дозатору</td>\
                <td>" + (sumPercent) + "</td>\
                " + html2 + "\
                <td></td>\
            </tr>");

        totalPercent += sumPercent;
    });

    $(".dynamicform_wrapper .d-total-percent").html(totalPercent);
    html = "";
    for (var i = 0; i < countBag; i++) {
        html += "<td class=\'temporarily\'></td>"
    }
    $(".dynamicform_wrapper .d-total-action").before(html);
}


//// запуск первоначальных функций

sumPercent();
$(\'.dynamicform_wrapper .e-percent\').bind(\'keyup change blur\', function(){
    sumPercent();
});
$("#d-count-bag").bind(\'keyup change blur\', function(){
    sumPercent();
});

//////////////// события FORM_WRAPPER
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    //изменение номерации дозаторов
    jQuery(".dynamicform_wrapper input.d-number-feeder").each(function(index) {
        jQuery(this).val((index + 1))
    });
    //добавление тары по умолчанию для новых дозаторов
    $(item).find(\'input.d-size-bag \').val(25);
    //перенос итогового блока
    $(\'.container-items\').append($(\'.container-items .d-total\'));

    sumPercent();

    /////добавление событий для новых дозаторов
    $(item).find(".dynamicform_inner").on("afterInsert", function(e, itemEl) {
        $(itemEl).find(\'.e-percent\').bind(\'keyup change blur\', function(){
            sumPercent();
        });
        sumPercent();
    });
    $(item).find(".dynamicform_inner").on("afterDelete", function(e) {
        sumPercent();
    });
    $(item).find(\'.e-percent\').bind(\'keyup change blur\', function(){
        sumPercent();
    });

});
jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    sumPercent();
});


//////////////////////////  события FORM_INNER
jQuery(".dynamicform_inner").on("afterInsert", function(e, item) {
    $(item).find(\'.e-percent\').bind(\'keyup change blur\', function(){
        sumPercent();
    });
    sumPercent();
});
jQuery(".dynamicform_inner").on("afterDelete", function(e) {
    sumPercent();
});




';

$this->registerJs($js);
?>


