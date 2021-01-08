<!-- Modal -->
<div class="modal fade" id="modal-new-product" tabindex="-1" role="dialog" aria-labelledby="new-product-lable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-product-lable">Adding New product</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-product">

                    <div class='row'>
                        <div class='col-6'>
                            <label for='new-product-name'>Product Name:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='text' id='new-product-name' name='new-product-name'
                                 onkeydown='return !(/[\!@#$%^&*=|~<>{}\/\"\[\]\\:?؟;.,`_]/i.test(event.key));' required>
                            </div>
                        </div>

                        <div class='col-6'>
                            <label for='new-product-category'>Category:</label>

                            <div class="custom-control custom-control-inline">
                                <select class="form-control" id="new-product-category" required>
                                    
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class='row mt-3'>

                        <div class='col'>
                            <label for='new-product-trade-mark'>Trade Mark:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='text' id='new-product-trade-mark' name='new-product-trade-mark' 
                                    onkeydown='return !(/[0-9\!@#$%^&*()+=\-|~<>{}\/\"\[\]\\:?؟;.,`_]/i.test(event.key));' required>
                            </div>
                        </div>

                        <div class='col'>
                            <label for='new-product-weight-liter'>Weight\Liter:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='number' min="0" id='new-product-weight-liter' aria-describedby="weightHelp" name='new-product-weight-liter' required>
                            </div>
                            <small id="weightHelp" class="form-text text-muted">Type 0 for Not Applicable.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-product">
                        
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="query-new-product">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
