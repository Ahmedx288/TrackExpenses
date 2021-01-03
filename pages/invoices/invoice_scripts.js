let item_no = 1;
var items_list_price;
var items_list_quantity;
var items_list_discount;
var invoice_total_pay = $('#invoice-total-pay');
var invoice_total_discount = $('#invoice-total-discount');

//adding items to the invoice list to be committed.
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

//remove an item from the item list;
$('#invoice-item-row').on('click', function (e) {
    var target = $(e.target);
    if (target.is("button")) {
        target.parent().parent().remove();//up col, up to row
        calculate_invoice(); //in case some items are removed.
    }
});

//On page load, refresh the customer, vendor, invoice number and products category data.
$(document).ready(
    function () {
        //update customer options
        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_customers.php",

            success: function (data) {
                $('#customer-options').html(data);
            }
        });

        //update vendor options
        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_vendors.php",

            success: function (data) {
                $('#vendor-options').html(data);
                $('#vendor-options-modal').html(data);
            }
        });

        ////update current invoice number
        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_invoice_number.php",

            success: function (data) {
                $('#invoice-number').html(data);
            }
        });

        ////update current product types
        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_product_types.php",

            success: function (data) {
                $('#new-product-category').html(data);
            }
        });
    }
);

//on any change in the items data, recalcualte the results.
$('#invoice-item-row').change(calculate_invoice);
//++++++++++++++++++++++++++++++
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

//adding new vendor to the database. (also update the vendor options simultaneously)
$('#query-new-vendor').click(
    function (e) {
        e.preventDefault();
        
        $('#result-add-new-vendor').children().remove();

        //form variables
        let new_vendor = $('#new-vendor-name').val();


        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/add_new_vendor.php",
            data: { "new_vendor": new_vendor },

            success: function (data) {
                $('#result-add-new-vendor').append(data);

                //update vendor options
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/functions/update_vendors.php",

                    success: function (data) {
                        $('#vendor-options').html(data);
                        $('#vendor-options-modal').html(data);
                    }
                });
            }
        });

    }
);

//adding new customer to the database. (also update the customer options simultaneously)
$('#query-new-customer').click(
    function (e) {
        e.preventDefault();

        $('#result-add-new-customer').children().remove();

        //form variables
        let new_customer_fName = $('#new-customer-fName').val();
        let new_customer_lName = $('#new-customer-lName').val();
        let new_customer_age = $('#new-customer-age').val();
        let new_customer_gender = $('#new-customer-gender').val();
        
        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/add_new_customer.php",
            data:
            {
                "fName": new_customer_fName,
                "lName": new_customer_lName,
                "age": new_customer_age,
                "gender": new_customer_gender,
            },

            success: function (data) {
                $('#result-add-new-customer').append(data);

                //update customer options
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/functions/update_customers.php",

                    success: function (data) {
                        $('#customer-options').html(data);
                    }
                });
            }
        });

    }
);

//adding new product to the database.
$('#query-new-product').click(
    function (e) {
        e.preventDefault();

        $('#result-add-new-product').children().remove();

        //form variables
        let new_product_name = $('#new-product-name').val();
        let new_product_category = $('#new-product-category').val();
        let new_product_tradeMark = $('#new-product-trade-mark').val();
        let new_product_weight = $('#new-product-weight-liter').val();

        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/add_new_product.php",
            data:
            {
                "pName": new_product_name,
                "pCategory": new_product_category,
                "pTradeMark": new_product_tradeMark,
                "pWeight": new_product_weight,
            },

            success: function (data) {
                $('#result-add-new-product').append(data);
            }
        });

    }
);

//adding new product-category to the database. (also update the product category options simultaneously)
$('#query-new-product-category').click(
    function (e) {
        e.preventDefault();

        $('#result-add-new-product-category').children().remove();

        //form variables
        let new_main_category = $('#new-product-main-category').val();
        let new_sub_category = $('#new-product-sub-category').val();


        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/add_new_product_category.php",
            data:
            {
                "main": new_main_category,
                "sub": new_sub_category,
            },

            success: function (data) {
                $('#result-add-new-product-category').append(data);

                ////update current product types
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/functions/update_product_types.php",

                    success: function (data) {
                        $('#new-product-category').html(data);
                    }
                });
            }
        });

    }
);

//adding new product to the database.
$('#query-new-vendor-location').click(
    function (e) {
        e.preventDefault();

        $('#result-add-new-vendor-location').children().remove();

        //form variables
        let vendor_name = $('#vendor-options-modal').find(":selected").text();
        let vendor_id = $('#vendor-options-modal').val();
        let new_vendor_location = $('#new-vendor-location').val();
        let vendor_city = $('#new-vendor-location-city').val();
        let $location_notes = $('#new-vendor-location-notes').val();

        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/add_new_vendor_location.php",
            data:
            {
                "vendor_name": vendor_name,
                "vendor_id": vendor_id,
                "new_location": new_vendor_location,
                "city": vendor_city,
                "address_notes": $location_notes,
            },

            success: function (data) {
                $('#result-add-new-vendor-location').append(data);
            }
        });

    }
);