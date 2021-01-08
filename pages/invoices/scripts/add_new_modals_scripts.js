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
            url: "pages/invoices/AJAX_functions/modal_functions/add_new_vendor.php",
            data: { "new_vendor": new_vendor },

            success: function (data) {
                $('#result-add-new-vendor').append(data);

                //update vendor options
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/AJAX_functions/options_functions/update_vendors.php",

                    success: function (data) {
                        $('#vendor-options').html(data);
                        $('#vendor-options-modal').html(data);

                        $('#form-add-new-vendor')[0].reset();
                    }
                });
            }
        });
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
    }

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
            url: "pages/invoices/AJAX_functions/modal_functions/add_new_vendor_location.php",
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
                    url: "pages/invoices/AJAX_functions/options_functions/update_vendor_locations.php",
                    data: { "vendor_id": vendor_id },

                    success: function (data) {
                        $('#vendor-location-options').html(data);

                        $('#form-add-new-vendor-location')[0].reset();
                    }
                });
            }
        });
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
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
            url: "pages/invoices/AJAX_functions/modal_functions/add_new_customer.php",
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
                    url: "pages/invoices/AJAX_functions/options_functions/update_customers.php",

                    success: function (data) {
                        $('#customer-options').html(data);

                        $('#form-add-new-customer')[0].reset();
                    }
                });
            }
        });
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
    }

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
            url: "pages/invoices/AJAX_functions/modal_functions/add_new_product.php",
            data:
            {
                "pName": new_product_name,
                "pCategory": new_product_category,
                "pTradeMark": new_product_tradeMark,
                "pWeight": new_product_weight,
            },

            success: function (data) {
                $('#result-add-new-product').append(data);

                $('#form-add-new-product')[0].reset();
            }
        });
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
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
            url: "pages/invoices/AJAX_functions/modal_functions/add_new_product_category.php",
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
                    url: "pages/invoices/AJAX_functions/options_functions/update_product_types.php",

                    success: function (data) {
                        $('#new-product-category').html(data);

                        $('#form-add-new-product-category')[0].reset();
                    }
                });
            }
        });
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
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
            required: 'Enter a valid Invoice Type',
            minlength: "At least 2 characters abbreviation"
        },
    },
    submitHandler: function () {
        $('#result-add-new-invoice-type').children().remove();

        //form variables
        let new_type = $('#new-invoice-type').val();

        $.ajax({
            type: "POST",
            url: "pages/invoices/AJAX_functions/modal_functions/add_new_invoice_type.php",
            data: { "new_type": new_type },

            success: function (data) {
                $('#result-add-new-invoice-type').append(data);

                ////update current invoice types
                $.ajax({
                    type: "GET",
                    url: "pages/invoices/AJAX_functions/options_functions/update_invoice_types.php",

                    success: function (data) {
                        $('#invoice-type-options').html(data);

                        $('#form-add-new-invoice-type')[0].reset();
                    }
                });
            }
        });
    },
    errorElement: "div",
    errorPlacement: function (error, element) {
        error.insertAfter(element.parent());
    }
});