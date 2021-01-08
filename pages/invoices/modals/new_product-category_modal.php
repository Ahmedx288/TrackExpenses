<!-- Modal -->
<div class="modal fade" id="modal-new-product-category" tabindex="-1" role="dialog" aria-labelledby="new-product-category-lable" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="new-product-category-lable">Adding New Product Category</h5>
                <button type="button" class="close ml-0" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="form-add-new-product-category">

                    <div class='row my-3'>
                        <div class='col'>
                            <label for='new-product-main-category'>Main Category:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='text' id='new-product-main-category' name='new-product-main-category' required>
                            </div>
                        </div>

                        <div class='col'>
                            <label for='new-product-sub-category'>Sub Category:</label>
                            <div class="custom-control custom-control-inline"> <!--positioning error message-->
                                <input type='text' id='new-product-sub-category' name='new-product-sub-category' required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="result-add-new-product-category">
                        
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="query-new-product-category">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                </form>
            </div>

        </div>

    </div>
</div>
