$("#search-item-rows").on('click', function (e) {
    var target = $(e.target);
    if (target.is("button")) {

        //up to col, up to row, children then first and finally ID Text.
        let id = parseInt(target.parent().parent().children().first().text());

        //update the modal data according to the selected invoice.
        $.ajax({
            type: "POST",
            url: "pages/reports/AJAX_functions/modal_functions/inspect_an_invoice.php",
            data: {invoice_id: id},

            success: function (data) {
                $('#invoice-details').html(data);
            }
        });
    }
});