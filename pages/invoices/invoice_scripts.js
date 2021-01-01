$('#add-invoice-item').click(
    function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: "pages/invoices/functions/create_invoice_item.php",

            success: function (data) {
                $('.invoice-item-row').append(data);
            }
        });
    }
);


