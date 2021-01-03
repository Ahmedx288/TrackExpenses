<!-- Modal -->
<div class="modal fade" id="modal-new-product" tabindex="-1" role="dialog" aria-labelledby="new product" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adding New product</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-product">

                    <div class='row'>
                        <div class='col-6'>
                            <label for='new-product-name'>Product Name:</label>
                            <input type='text' id='new-product-name' name='new-product-name' required>
                        </div>

                        <div class='col-6'>
                            <label for='new-product-category'>Category:</label>

                            <div class="custom-control custom-control-inline">
                                <select type="text" class="form-control" id="new-product-category" required>
                                    
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class='row mt-3'>

                        <div class='col'>
                            <label for='new-product-lName'>Trade Mark:</label>
                            <input type='text' id='new-product-trade-mark' name='new-product-trade-mark' onkeypress="return /[a-z]/i.test(event.key)" required>
                        </div>

                        <div class='col'>
                            <label for='new-product-age'>Weight\Liter:</label>
                            <input type='number' min="0" id='new-product-weight-liter' aria-describedby="weightHelp" name='new-product-weight-liter' required>
                            <small id="weightHelp" class="form-text text-muted">Type 0 for Not Applicable.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-product">
                        
                        </div>
                    </div>

                </form>
            </div>

            
           <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="query-new-product">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>
</div>
