<!-- Modal -->
<div class="modal fade" id="modal-new-vendor-location" tabindex="-1" role="dialog" aria-labelledby="new-vendor-location-lable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-vendor-location-lable">Adding New Vendor Location</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-vendor-location">
                    <div class="row">
                        <div class="col">
                            <label for="vendor-options-modal">Vendor:</label>

                            <div class="custom-control custom-control-inline">

                                <select class="form-control vendor-list" id="vendor-options-modal" required>

                                </select>

                            </div>
                        </div>

                        <div class='col'>
                            <label for='new-vendor-location-city'>City of Location:</label>
                            <input type='text' id='new-vendor-location-city' name='new-vendor-location-city' required>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col offset-6'>
                            <label for='new-vendor-location'>Location:</label>
                            <input type='text' id='new-vendor-location' name='new-vendor-location' required>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='col'>
                            <div class="form-group">
                                <label for='new-vendor-location-notes'>Location notes:</label>
                                <textarea class="form-control" id="new-vendor-location-notes" rows="2" maxlength="250"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-vendor-location">
                        
                        </div>
                    </div>

                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="query-new-vendor-location">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
