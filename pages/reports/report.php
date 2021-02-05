<?php include "modals/invoice_inspection_modal.php"; ?>

<div class="row border">
    <div class="col-10 offset-1">

        <div class="row">
            <div class="col pb-3">
                <h1  class="text-center">Reports</h1>        
            </div>
        </div>

        <div class="row">
            <div class="col">

                <h2><strong>Search Criteria</strong></h2>

                <form id="search-main-information" class="border">
                
                    <div class="form-row m-2">

                        <div class="col-6">

                            <label for="customer-options-search">Buyer (Customer):</label>
                            <div class="custom-control custom-control-inline">
                                <select class="form-control" id="customer-options-search" name="customer-options-search" required>

                                </select>
                            </div>

                        </div>

                    </div>

                    <div class="form-row m-2">
                        
                        <div class="col-6">            
                            <label for="vendor-options-search">Store (Vendor):</label>
                            <div class="custom-control custom-control-inline">
                                <select class="form-control" id="vendor-options-search" name="vendor-options-search" required>

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-row m-2">
                        <div class="col-2 offset-10">
                            <button type="submit" class="btn btn-primary m-2">Search</button>                
                        </div>
                    </div>

                </form>

            </div>
        </div>

        <div class="row border mt-3">
            <div class="col">

                <h2><strong>Results</strong></h2>

                <div class="row border-bottom">

                    <div class="col-1">
                        <p>#ID</p>
                    </div>

                    <div class="col-2">
                        <p>Buyer</p>
                    </div>

                    <div class="col-2">
                        <p>Store</p>
                    </div>

                    <div class="col">
                        <p>Type</p>
                    </div>

                    <div class="col-2">
                        <p>Date</p>
                    </div>

                    <div class="col-2">
                        <p>Time</p>
                    </div>

                    <div class="col">
                        <p>More Info.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col" id="search-item-rows" style="max-height: 290px; overflow-y: scroll;">
                                
                    </div>
                </div>
                    
            </div>
        </div>

        <div id="result-search">
        </div>
    </div>
</div>