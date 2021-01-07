//adding items to the invoice list to be committed.
$('#add-invoice-item').click(
    function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "pages/invoices/AJAX_functions/create_invoice_item.php",
            data: { "item_no": item_no },

            success: function (data) {
                item_no++;
                $('#invoice-item-row').append(data);
            }
        });
    }
);

//remove an item from the item list;
$('#invoice-item-row').on('click', function (e) {
    var target = $(e.target);
    if (target.is("button")) {
        target.parent().parent().remove();//up col, up to row
        calculate_invoice(); //in case some items are removed.
    }
});

//on any change in the items data, recalcualte the results.
$('#invoice-item-row').change(calculate_invoice);
//++++++++++++++++++++++++++++++
function calculate_invoice() {
    items_unitPrice_list = $('#invoice-item-row').find('.unit-price');
    items_unitQuantity_list = $('#invoice-item-row').find('.unit-quantity');
    items_unitDiscount_list = $('#invoice-item-row').find('.unit-discount');
    items_unitTotalPrice_list = $('#invoice-item-row').find('.unit-total-price');

    let temp_sum = 0;
    let temp_discount = 0;

    if (items_unitPrice_list.length > 0) {
        for (i = 0; i < items_unitPrice_list.length; i++) {
            items_unitTotalPrice_list[i].value = (parseFloat(items_unitPrice_list[i].value) * parseFloat(items_unitQuantity_list[i].value) - parseFloat(items_unitDiscount_list[i].value)).toFixed(2);

            temp_sum += parseFloat(items_unitTotalPrice_list[i].value);
            temp_discount += parseFloat(items_unitDiscount_list[i].value);
        }

        invoice_total_pay[0].value = temp_sum;
        invoice_total_discount[0].value = temp_discount;
    } else {
        invoice_total_pay[0].value = 0;
        invoice_total_discount[0].value = 0;
    }
}