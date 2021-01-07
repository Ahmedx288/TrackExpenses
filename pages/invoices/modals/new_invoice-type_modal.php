<!-- Modal -->
<div class="modal fade" id="modal-new-invoice-type" tabindex="-1" role="dialog" aria-labelledby="new-invoice-type-lable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-invoice-type-lable">Adding New Invoice Type</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-invoice-type">

                    <div class='row'>
                        <div class='col'>
                            <label for='new-invoice-type'>New Type:</label>
                            <input type='text' id='new-invoice-type' name='new-invoice-type' required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-invoice-type">
                        
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="query-new-invoice-type">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                </form>
            </div>

        </div>

    </div>
</div>
