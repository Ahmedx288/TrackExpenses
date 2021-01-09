//On page load, refresh the customer, and vendor data.
$(document).ready(
    function () {
        //update customer options
        $.ajax({
            type: "GET",
            url: "pages/reports/AJAX_functions/options_functions/update_customers.php",

            success: function (data) {
                $('#customer-options-search').html(data);
            }
        });

        //update vendor options
        $.ajax({
            type: "GET",
            url: "pages/reports/AJAX_functions/options_functions/update_vendors.php",

            success: function (data) {
                $('#vendor-options-search').html(data);
            }
        });
    }
);