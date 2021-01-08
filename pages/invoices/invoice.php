<?php include "modals/new_vendor_modal.php"; ?>
<?php include "modals/new_customer_modal.php"; ?>
<?php include "modals/new_product_modal.php"; ?>
<?php include "modals/new_product-category_modal.php"; ?>
<?php include "modals/new_vendor-location_modal.php"; ?>
<?php include "modals/new_invoice-type_modal.php"; ?>

<div class="row border">
    <div class="col-2 border">
        
        <div class="row">
            <div class="col my-3">
                <button id="add-new-vendor" type="button" class="btn btn-primary btn-lg btn-block"
                    data-toggle="modal" data-target="#modal-new-vendor">Add New Vendor</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button id="add-new-vendor-location" type="button" class="btn btn-primary btn-lg btn-block"
                    data-toggle="modal" data-target="#modal-new-vendor-location">Add Vendor Location</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button id="add-new-customer" type="button" class="btn btn-primary btn-lg btn-block"
                    data-toggle="modal" data-target="#modal-new-customer">Add New Customer</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button id="add-new-product" type="button" class="btn btn-primary btn-lg btn-block"
                    data-toggle="modal" data-target="#modal-new-product">Add New Product</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button id="add-new-product-category" type="button" class="btn btn-primary btn-lg btn-block"
                    data-toggle="modal" data-target="#modal-new-product-category">Add Product Category</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button id="add-new-invoice-type" type="button" class="btn btn-primary btn-lg btn-block"
                    data-toggle="modal" data-target="#modal-new-invoice-type">Add New Invoice Type</button>
            </div>
        </div>

    </div>

    <div class="col-10">

        <div class="row">
            <div class="col pb-3">
                <h1  class="text-center">Invoice #<span id="invoice-number"></span></h1>        
            </div>
        </div>


        <form id="invoice-main-information">
        
            <div class="row">

                <div class="col-6">
                    <label for="customer-options">Customer:</label>
                    <div class="custom-control custom-control-inline">
                        <select class="form-control" id="customer-options" name="customer-options" required>

                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <label for="date-purchased">Date:</label>
                    <div class="custom-control custom-control-inline">
                        <input type="date" id="date-purchased" name="date-purchased" required>
                    </div>
                </div>

            </div>

            <div class="row mt-2">
                
                <div class="col-6">            
                    <label for="vendor-options">Vendor:</label>
                    <div class="custom-control custom-control-inline">
                        <select class="form-control" id="vendor-options" name="vendor-options" required>

                        </select>
                    </div>
                </div>

                <div class="col-6">
                    <label for="time-purchased">Time:</label>
                    <div class="custom-control custom-control-inline">
                        <input type="time" id="time-purchased" name="time-purchased" value="00:00:01" required>
                    </div>
                </div>

            </div>

            <div class="row mt-2">
                
                <div class="col-6">            
                    <label for="vendor-location-options">Location:</label>
                    <div class="custom-control custom-control-inline">
                        <select class="form-control" id="vendor-location-options" name="vendor-location-options" required>

                        </select>
                    </div>
                </div>

                <div class="col-6"> 
                    <label for="invoice-type-options">Invoice type:</label>
                    <div class="custom-control custom-control-inline">
                        <select class="form-control" id="invoice-type-options" name="invoice-type-options" required>

                        </select>
                    </div>
                </div>

            </div>

            <div class="row mt-3 p-2 border">

                <div class="col">

                    <div class="row border-bottom">
                        <div class="col-1">
                            <button type="button" class="btn btn-secondary" id="add-invoice-item">+</button>
                        </div>

                        <div class="col-3">
                            <p>Product</p>
                        </div>

                        <div class="col-3">
                            <p>Price</p>
                        </div>

                        <div class="col">
                            <p>Quantity</p>
                        </div>

                        <div class="col">
                            <p>Discount</p>
                        </div>

                        <div class="col-2">
                            <p>Total Pay</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col" id="invoice-item-row" style="max-height: 290px; overflow-y: scroll;">
                            
                        </div>
                    </div>
                
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-3">
                    <label for="invoice-total-pay">Invoice Total Pay:</label>
                    <input type="number" inputmode="decimal" class="form-control" id="invoice-total-pay" value="0" readonly>
                </div>

                <div class="col-3">
                    <label for="invoice-total-discount">Invoice Total Discount:</label>
                    <input type="number" inputmode="decimal" class="form-control" id="invoice-total-discount" value="0" readonly>
                </div>

                <div class="col-3">
                    <label for="invoice-payment-method">Invoice Payment Method:</label>
                    <div class="dummy"> <!--positioning error message-->
                        <select class="form-control" id="invoice-payment-method" name="invoice-payment-method" required>
                            <option hidden disabled selected value=""> -- Select a Method -- </option>
                            <option value="cash">Cash</option>
                            <option value="electronic">Electronic</option>
                        </select>
                    </div>
                </div>

                <div class="col-2 offset 1">
                    <button type="submit" class="btn btn-primary mt-4">Save</button>                
                </div>
            
            </div>

        </form>

        <div id="result-save-invoice">
        </div>
    </div>
</div>