<!-- Modal -->
<div class="modal fade" id="modal-new-vendor" tabindex="-1" role="dialog" aria-labelledby="new-vendor-lable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-vendor-lable">Adding New Vendor</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-vendor">

                    <div class='row'>
                        <div class='col'>
                            <label for='new-vendor-name'>Vendor Name:</label>
                            <input type='text' id='new-vendor-name' name='new-vendor-name' required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-vendor">
                        
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="query-new-vendor">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                </form>
            </div>

        </div>

    </div>
</div>
