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

//On page load, refresh the customer, vendor, invoice number, products category and invoice types data.
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

        ////update current invoice types
        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/update_invoice_types.php",

            success: function (data) {
                $('#invoice-type-options').html(data);
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

//With every change in the vendor selection update the location list to the available locations
$("#vendor-options").change(
    function () {
        let vendor_id = $('#vendor-options').val();

        //update the location list
        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/update_vendor_locations.php",
            data: { "vendor_id": vendor_id },

            success: function (data) {
                $('#vendor-location-options').html(data);
            }
        });
    }
);

//adding new vendor to the database. (also update the vendor options simultaneously)
$('#form-add-new-vendor').validate({
    rules: {
        "new-vendor-name": {
            required: true,
            minlength: 1
        }          
    },

    messages: {
        "new-vendor-name": {
            required: 'Please Enter a vendor name',
            minlength: "Your data must be at least 1 characters"
        }
    },

    submitHandler: function () {
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
    },
    
});

//adding new vendor location to the database. (also update the vendor location options simultaneously)
$('#form-add-new-vendor-location').validate({
    rules: {
        "new-vendor-location-city": {
            required: true,
            minlength: 2
        },
        "new-vendor-location": {
            required: true,
            minlength: 2
        }
    },

    messages: {
        "new-vendor-location-city": {
            required: 'Enter valid City',
            minlength: "At least 2 characters abbreviation"
        },
        "new-vendor-location": {
            required: 'Enter a valid location',
            minlength: "At least 2 characters abbreviation"
        }
    },

    submitHandler: function () {
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

                //update the location list
                $.ajax({
                    type: "POST",
                    url: "pages/invoices/functions/update_vendor_locations.php",
                    data: { "vendor_id": vendor_id },

                    success: function (data) {
                        $('#vendor-location-options').html(data);
                    }
                });
            }
        });
    }
    
});

//adding new customer to the database. (also update the customer options simultaneously)
$('#form-add-new-customer').validate({
    rules: {
        "new-customer-fName": {
            required: true,
            minlength: 2
        },
        "new-customer-lName": {
            required: true,
            minlength: 2
        }
    },

    messages: {
        "new-customer-fName": {
            required: 'Enter valid City',
            minlength: "At least 2 characters abbreviation"
        },
        "new-customer-lName": {
            required: 'Enter a valid location',
            minlength: "At least 2 characters abbreviation"
        }
    },

    submitHandler: function () {
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
    },

});

//adding new product to the database.
$('#form-add-new-product').validate({
    rules: {
        "new-product-name": {
            required: true,
            minlength: 2
        },
        "new-product-trade-mark": {
            required: true,
            minlength: 2
        }
    },

    messages: {
        "new-product-name": {
            required: 'Enter a valid product name',
            minlength: "At least 2 characters abbreviation"
        },
        "new-product-trade-mark": {
            required: 'Enter a valid product tradeMark',
            minlength: "At least 2 characters abbreviation"
        }
    },

    submitHandler: function () {
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
});

//adding new product-category to the database. (also update the product category options simultaneously)
$('#form-add-new-product-category').validate({
    rules: {
        "new-product-main-category": {
            required: true,
            minlength: 2
        },
        "new-product-sub-category": {
            required: true,
            minlength: 2
        }
    },

    messages: {
        "new-product-main-category": {
            required: 'Enter a valid Main category',
            minlength: "At least 2 characters abbreviation"
        },
        "new-product-sub-category": {
            required: 'Enter a valid Sub category',
            minlength: "At least 2 characters abbreviation"
        }
    },
    
    submitHandler: function () {
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
});

//adding new invoice type to the database. (also update the invoice type options simultaneously)
$('#form-add-new-invoice-type').validate({
    rules: {
        "new-invoice-type": {
            required: true,
            minlength: 2
        },
    },

    messages: {
        "new-invoice-type": {
            required: 'Enter a valid Main category',
            minlength: "At least 2 characters abbreviation"
        },
    },
    submitHandler: function () {
        $('#result-add-new-invoice-type').children().remove();

        //form variables
        let new_type = $('#new-invoice-type').val();

        $.ajax({
            type: "POST",
            url: "pages/invoices/functions/add_new_invoice_type.php",
            data: { "new_type": new_type },

            success: function (data) {
                $('#result-add-new-invoice-type').append(data);

                ////update current invoice types
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/functions/update_invoice_types.php",

                    success: function (data) {
                        $('#invoice-type-options').html(data);
                    }
                });
            }
        });
    }
});