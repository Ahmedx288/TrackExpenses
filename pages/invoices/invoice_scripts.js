let item_no = 1;
var items_list_price;
var items_list_quantity;
var items_list_discount;
var invoice_total_pay = $('#invoice-total-pay');
var invoice_total_discount = $('#invoice-total-discount');

$('#add-invoice-item').click(
    function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/create_invoice_item.php",
            data: { "item_no": item_no},

            success: function (data) {
                item_no++;
                $('#invoice-item-row').append(data);
            }
        });
    }
);


$(document).ready(
    function () {
        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_customers.php",

            success: function (data) {
                $('#customer').html(data);
            }
        });

        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_vendors.php",

            success: function (data) {
                $('#vendor').html(data);
            }
        });

        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_invoice_number.php",

            success: function (data) {
                $('#invoice-number').html(data);
            }
        });
    }
);

//remove an item from the item list;
$('#invoice-item-row').on('click', function (e) {
    var target = $(e.target);
    if (target.is("button")){
        target.parent().parent().remove();//up col, up to row
        calculate_invoice(); //in case some items are removed.
    }
});

//on any change in the items data, recalcualte the results.
$('#invoice-item-row').change(calculate_invoice);


function calculate_invoice(){
    items_list_price = $('#invoice-item-row').find('.unit-price');
    items_list_quantity = $('#invoice-item-row').find('.unit-quantity');
    items_list_discount = $('#invoice-item-row').find('.unit-discount');
    items_list_total = $('#invoice-item-row').find('.unit-total');

    let temp_sum = 0;
    let temp_discount = 0;

    if (items_list_price.length > 0){
        for (i = 0; i < items_list_price.length; i++) {
            items_list_total[i].value = (parseFloat(items_list_price[i].value) * parseFloat(items_list_quantity[i].value) - parseFloat(items_list_discount[i].value)).toFixed(2);

            temp_sum += parseFloat(items_list_total[i].value);
            temp_discount += parseFloat(items_list_discount[i].value);

            invoice_total_pay[0].value = temp_sum;
            invoice_total_discount[0].value = temp_discount;
        }
    } else {
        invoice_total_pay[0].value = 0;
        invoice_total_discount[0].value = 0;
    }
}