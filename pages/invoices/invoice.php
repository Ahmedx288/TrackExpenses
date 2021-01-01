<?php include "assets/modal.php"; ?>

<div class="row border">
    <div class="col-3 border">
        
        <div class="row">
            <div class="col my-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">Add New Product</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">Add Product Category</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">Add New Customer</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">Add New Vendor</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">Add Vendor Location</button>
            </div>
        </div>

        <div class="row">
            <div class="col my-3">
                <button type="button" class="btn btn-primary btn-lg btn-block">Rate a product</button>
            </div>
        </div>

    </div>

    <div class="col-9">

        <div class="row">
            <div class="col pb-3">
                <h1  class="text-center">Invoice #<span id="invoice-number"></span></h1>        
            </div>
        </div>


        <form action="">
        
            <div class="row">

                <div class="col-6">

                    <label for="customer">Customer:</label>

                    <div class="custom-control custom-control-inline">

                        <select type="text" class="form-control customer-list" id="customer" required>

                        </select>

                    </div>

                </div>

                <div class="col-6">
                    
                    <label for="date-purchased">Date:</label>
                    <input type="date" id="date-purchased" name="date-purchased" required>
                    

                </div>

            </div>

            <div class="row pt-1">
                
                <div class="col-6">
                
                    <label for="vendor">Vendor:</label>

                    <div class="custom-control custom-control-inline">

                        <select type="text" class="form-control vendor-list" id="vendor" required>

                        </select>

                    </div>

                </div>

                <div class="col-6">
                    <label for="time-purchased">Time:</label>
                    <input type="time" id="time-purchased" name="time-purchased" required>
                </div>

            </div>

            <div class="row mt-3 p-2 border">
                <div class="col">

                    <div class="row">
                        <div class="col-1">
                            <button type="button" class="btn btn-secondary" id="add-invoice-item">+</button>
                        </div>

                        <div class="col-3">
                            <p class="text-center">Product</p>
                        </div>

                        <div class="col-2">
                            <p class="text-center">Price</p>
                        </div>

                        <div class="col-2">
                            <p class="text-center">Quantity</p>
                        </div>

                        <div class="col-2">
                            <p class="text-center">Discount</p>
                        </div>

                        <div class="col-2">
                            <p class="text-center">Total Pay</p>
                        </div>
                    </div>

                    <div class="row">
                        <div id="invoice-item-row" class="col">
                            
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
                        <select type="text" class="form-control" id="invoice-payment-method">
                            <option value="cash" selected>Cash</option>
                            <option value="electronic">Electronic</option>
                        </select>
                </div>

                <div class="col-2 offset 1">
                    <button type="submit" class="btn btn-primary mt-4">Save</button>                
                </div>
            
            </div>

        </form>
    
    
    </div>
</div>