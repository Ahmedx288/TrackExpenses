//TRANSACT an invoice and all its items. (also update the invoice number simultaneously)
$('#invoice-main-information').validate({
    submitHandler: function () {
        $('#result-save-invoice').children().remove();

        //form variables
        //(1) Invoice Table part
        let next_invoice_id = parseInt($('#invoice-number').text());
        let customer_id = $('#customer-options').val();
        let vendor_id = $('#vendor-options').val();
        let vendor_location_id = $('#vendor-location-options').val();
        let invoice_date = $('#date-purchased').val();
        let invoice_time = $('#time-purchased').val();
        let invoice_type_id = $('#invoice-type-options').val();
        let payment_method = $('#invoice-payment-method').val();

        //(2) Invoice Items Part (*Select all Jquery Objects and extract only needed values
        //                        *equls to loop over the collection and append values in a new array)
        items_invoiceItems_list = $('#invoice-item-row').find('.unit-item').map((i, e) => e.value).get();
        items_unitPrice_list = $('#invoice-item-row').find('.unit-price').map((i, e) => e.value).get();
        items_unitQuantity_list = $('#invoice-item-row').find('.unit-quantity').map((i, e) => e.value).get();
        items_unitDiscount_list = $('#invoice-item-row').find('.unit-discount').map((i, e) => e.value).get();
        //total price for each unit is updated in the database using a triggr
        //invoice total payment is updated using a procedure that we call.

        $.ajax({
            type: "POST",
            url: "pages/invoices/AJAX_functions/TRANSACT_INVOICE.php",
            data: {
                "invoice_id": next_invoice_id,
                "customer_id": customer_id,
                "vendor_id": vendor_id,
                "vendor_location_id": vendor_location_id,
                "invoice_date": invoice_date,
                "invoice_time": invoice_time,
                "invoice_type_id": invoice_type_id,
                "payment_method": payment_method,
                "invoiceItems_list": items_invoiceItems_list,
                "unitPrice_list": items_unitPrice_list,
                "unitQuantity_list": items_unitQuantity_list,
                "unitDiscount_list": items_unitDiscount_list,
            },

            success: function (data) {
                $('#result-save-invoice').append(data);

                //update current invoice number
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/AJAX_functions/options_functions/update_invoice_number.php",

                    success: function (data) {
                        $('#invoice-number').html(data);
                        current_invoice_id = parseInt(data);

                        //reset the invoice fields only if the subbmission is done without errors.
                        if (current_invoice_id != next_invoice_id) {
                            $('#invoice-main-information')[0].reset(); //reset all fields
                            $('#invoice-item-row').find('.row').remove(); //clear invoice items
                        }
                    }
                });
            }
        });
    }

});