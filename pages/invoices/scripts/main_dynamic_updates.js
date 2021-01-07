let item_no = 1;
let current_invoice_id;
let items_invoiceItems_list;
let items_unitPrice_list;
let items_unitQuantity_list;
let items_unitDiscount_list;
let items_unitTotalPrice_list;
let invoice_total_pay = $('#invoice-total-pay');
let invoice_total_discount = $('#invoice-total-discount');

//On page load, refresh the customer, vendor, invoice number, products category and invoice types data.
$(document).ready(
    function () {
        //update customer options
        $.ajax({
            type: "GET",
            url: "pages/invoices/AJAX_functions/options_functions/update_customers.php",

            success: function (data) {
                $('#customer-options').html(data);
            }
        });

        //update vendor options
        $.ajax({
            type: "GET",
            url: "pages/invoices/AJAX_functions/options_functions/update_vendors.php",

            success: function (data) {
                $('#vendor-options').html(data);
                $('#vendor-options-modal').html(data);
            }
        });

        ////update current invoice number
        $.ajax({
            type: "GET",
            url: "pages/invoices/AJAX_functions/options_functions/update_invoice_number.php",

            success: function (data) {
                $('#invoice-number').html(data);
                current_invoice_id = parseInt(data);
            }
        });

        ////update current product types
        $.ajax({
            type: "GET",
            url: "pages/invoices/AJAX_functions/options_functions/update_product_types.php",

            success: function (data) {
                $('#new-product-category').html(data);
            }
        });

        ////update current invoice types
        $.ajax({
            type: "GET",
            url: "pages/invoices/AJAX_functions/options_functions/update_invoice_types.php",

            success: function (data) {
                $('#invoice-type-options').html(data);
            }
        });

    }
);

//With every change in the vendor selection update the location list to the available locations
$("#vendor-options").change(
    function () {
        let vendor_id = $('#vendor-options').val();

        //update the location list
        $.ajax({
            type: "POST",
            url: "pages/invoices/AJAX_functions/options_functions/update_vendor_locations.php",
            data: { "vendor_id": vendor_id },

            success: function (data) {
                $('#vendor-location-options').html(data);
            }
        });
    }
);