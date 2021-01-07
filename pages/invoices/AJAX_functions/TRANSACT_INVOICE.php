<?php

    require "../../../assets/establish_close_connection.php";

    /* Tell mysqli to throw an exception if an error occurs */
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	$conn = OpenCon();


    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
            //Invoice Table Data
                $invoice_id = $_POST["invoice_id"];
                $customer_id = $_POST["customer_id"];
                $vendor_id = $_POST["vendor_id"];
                $vendor_location_id = $_POST["vendor_location_id"];
                $invoice_type_id = $_POST["invoice_type_id"];
                $payment_date = $_POST["invoice_date"];
                $payment_time = $_POST["invoice_time"];
                $payment_method = $_POST["payment_method"];
            //Invoice Items Data
                $invoiceItems_IDs_list =  $_POST["invoiceItems_list"];
                $unitPrice_list = $_POST["unitPrice_list"];
                $unitQuantity_list = $_POST["unitQuantity_list"];
                $unitDiscount_list = $_POST["unitDiscount_list"];

        $conn->begin_transaction(); // i.e., start transaction
        try { 

            // STEP 1: Create an invoice that will hold the invoice_items data within.
                $result = $conn->query("INSERT INTO invoice (id, customer_id, vendor_id, location_id, invoice_type_id, payment_date, payment_time, payment_method)
                                        VALUES ($invoice_id, $customer_id, $vendor_id, $vendor_location_id, $invoice_type_id, DATE '$payment_date', '$payment_time', '$payment_method')");
            /**************************************************************/
            
            // STEP 2: Insert the items related to the created invoice in invoice_item Table.
                $query = "INSERT INTO invoice_item (invoice_id, product_id, price, quantity, total_discount) VALUES ";
                $query_values = array();
                for ($i = 0; $i < count($invoiceItems_IDs_list) ; $i++){
                    $query_values[] = "($invoice_id, $invoiceItems_IDs_list[$i], $unitPrice_list[$i], $unitQuantity_list[$i], $unitDiscount_list[$i])";
                }

                $conn->query($query . implode(", ", $query_values) . ";");
            /**************************************************************/

            //STEP 3: go back to invoice Table to insert Total_payment col value for the invoice;
                $conn->query("call calculateInvoiceTotalPayment($invoice_id);");
            /**************************************************************/

            // SQL queries have been successful, go back to non-transaction mode.
            $conn->commit();    // i.e., end transaction

            print"  <div class='alert alert-success' role='alert'>
                        The Invoice #$invoice_id has been successfully added.
                    </div>";
        } catch ( mysqli_sql_exception $exception ) {
            $conn->rollback();

            echo "<div class='alert alert-danger mt-4' role='alert'>";
            if(substr($exception->getMessage(), 0, 37) == "You have an error in your SQL syntax;"){
                echo "Error: You can't submit an empty invoice (no items have been selected).";    
            } else if (substr($exception->getMessage(), 0, 9) == "Duplicate") {
                echo "Error: You can't have the same item twice in your invoice."; 
            } else {
                echo "Error: " . $exception->getMessage();
            }
            echo"</div>";
            //throw $exception;
        } 
    } 

    CloseCon($conn);
?>