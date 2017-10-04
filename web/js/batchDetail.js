
// Поиск и добавление ячейки с суммой процентов по дозатору
function sumPercent(){
    var countBag = Number($("#d-count-bag").val());
    countBag = countBag > 10 ? 10 : countBag;
    var amount = Number($("#d-amount").val());
    var totalPercent = 0;
    var cost = 0;
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
            elemCost = Number($(this).find("input.e-cost").val());
            cost += elemCost * percent/100;
            koef = (percent != maxPercent ? koefMain*percent : (percent != 0 ? sizeBag : "" ) )
            for (var i = 1; i <= countBag; i++) {
                mas[i-1] += (koef*i);
                if(percent != maxPercent){
                    html += "<td class='temporarily'>" + (koef*i).toFixed(4) + "</td>";
                } else {
                    html += "<td class='temporarily'><u>" + (koef*i).toFixed(4) + "</u></td>";
                }
            }
            $(this).find(".e-td-action").before(html);
        });

        ///формирование заголовка и итогов таблицы с элементами
        html = "";
        html2 = "";
        for (var i = 1; i <= countBag; i++) {
            html += "<th class='temporarily'>(" + (i) + ")</th>";
            if(sumPercent != 0){
                val = (mas[i-1]).toFixed(2) + "кг (" + (amount/(mas[i-1]/(sumPercent/100))).toFixed(2) + " замесов)"
            } else {
                val = "-";
            }
            html2 += "<td class='temporarily'>" + val + "</td>"
        }
        $(this).find(".e-th-action").before(html);

        $(this).find(".container-elements").append("\
            <tr class='e-total temporarily'>\
                <td>Итого по дозатору</td>\
                <td>" + (sumPercent) + "</td>\
                <td></td>\
                " + html2 + "\
                <td></td>\
            </tr>");

        totalPercent += sumPercent;
    });

    $(".dynamicform_wrapper .d-total-percent").html(totalPercent);
    $(".dynamicform_wrapper .d-total-cost").html(cost.toFixed(2));
//    $("#d-cost").val(cost.toFixed(2));
    if(totalPercent > 100){
        $(".dynamicform_wrapper .d-total-percent").addClass("red");
    } else {
        $(".dynamicform_wrapper .d-total-percent").removeClass("red");
    }

    html = "";
    for (var i = 0; i < countBag; i++) {
        html += "<td class='temporarily'></td>"
    }
    $(".dynamicform_wrapper .d-total-action").before(html);

}

function updateEven(item){
    $(item).find('.e-percent').bind('keyup change blur', function(){
        sumPercent();
    });
    $(item).find('.e-cost').bind('keyup change blur', function(){
        sumPercent();
    });
    $(item).find('input.e-cost').typeahead({
                hint: false,
                highlight: true,
                minLength: 0
            }, {
                display: 'value',
                source: function (query, syncResults, async) {
                    material = $(this.$el).closest('.elem-item').find('select.e-material').val(); //('.elem-item'));
                    $.post('/material-coming/cost-list' + (material ? '?id_material=' +  material: ''),{ 'id_material': material},
                        function (response) {
                            async(response);
                        },
                        'json'
                    );
                },
                templates: {
                    empty: [
                        '<div class="empty-message">',
                        'Цены не найдены!',
                        '</div>'
                    ].join('\n'),
                    suggestion: function (data) {
                        return '<div><strong>' + data.value + '</strong> <small>(' + data.date + ')</small></div>';
                    }
                }
    });
}

//// запуск первоначальных функций

sumPercent();

updateEven($('.dynamicform_wrapper'));

$('.dynamicform_wrapper .d-size-bag').bind('keyup change blur', function(){
    sumPercent();
});

$("#d-count-bag").bind('keyup change blur', function(){
    sumPercent();
});



//////////////// события FORM_WRAPPER
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    //изменение номерации дозаторов
    jQuery(".dynamicform_wrapper input.d-number-feeder").each(function(index) {
        jQuery(this).val((index + 1))
    });
    //добавление тары по умолчанию для новых дозаторов
    $(item).find('input.d-size-bag ').val(25);
    //перенос итогового блока
    $('.container-items').append($('.container-items .d-total'));

    sumPercent();
    updateEven(item);

    /////добавление событий для новых дозаторов
    $(item).find(".dynamicform_inner").on("afterInsert", function(e, itemEl) {
        updateEven(itemEl);
        sumPercent();
    });
    $(item).find(".dynamicform_inner").on("afterDelete", function(e) {
        sumPercent();
    });

    $(item).find('.d-size-bag').bind('keyup change blur', function(){
        sumPercent();
    });

});
jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    sumPercent();
});


//////////////////////////  события FORM_INNER
jQuery(".dynamicform_inner").on("afterInsert", function(e, item) {
    updateEven(item);
    sumPercent();
});
jQuery(".dynamicform_inner").on("afterDelete", function(e) {
    sumPercent();
});


