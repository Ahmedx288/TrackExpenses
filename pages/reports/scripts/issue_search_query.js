$('#search-main-information').validate({

    submitHandler: function () {
        let customer_id = parseInt($('#customer-options-search').val());
        let vendor_id = parseInt($('#vendor-options-search').val());

        $.ajax({
            type: "POST",
            url: "pages/reports/AJAX_functions/create_search_items.php",
            data: {
                "customer_id": customer_id,
                "vendor_id": vendor_id,
            },

            success: function (data) {
                $('#search-item-rows').html(data);
            }
        });
    }
});