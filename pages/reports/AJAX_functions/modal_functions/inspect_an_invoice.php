<?php

    require "../../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {

        $id = $_POST['invoice_id'];
        $i = 0;


        $res = $conn->query("SELECT * 
                             FROM invoice_item JOIN product
                             ON invoice_item.product_id = product.id
                             WHERE invoice_id=$id;");
        
        $res_additional = $conn->query("SELECT * FROM invoice WHERE id=$id");

        echo <<<EOL
            <div class="row border-bottom">
                <div class="col-1">#</div>

                <div class="col-3"> <p>Product</p> </div>

                <div class="col-3"> <p>Price</p> </div>

                <div class="col"> <p>Quantity</p> </div>

                <div class="col"> <p>Discount</p> </div>

                <div class="col-2"> <p>Total Pay</p> </div>
            </div>
EOL;
        while($row = $res->fetch_assoc()){
            $i++;
            echo "<div class='row mt-1'>";

                echo '<div class="col-1">';
                    echo "<p>$i</p>";
                echo '</div>';

                echo '<div class="col-3">';
                    echo "<p>${row['name_']}</p>";
                echo '</div>';

                print "
                    <div class='col-3'>
                        <p>${row['price']}</p>
                    </div>

                    <div class='col'>
                        <p>${row['quantity']}</p>
                    </div>

                    <div class='col'>
                        <p>${row['total_discount']}</p>
                    </div>

                    <div class='col-2'>
                        <p>${row['total_pay']}</p>
                    </div>"
                ;

            echo '</div>';
        }

        $row = $res_additional->fetch_assoc();
        echo <<<EOL
            <div class="row border-top mt-3">
                <div class="col"> <p style="color: red">Total Payment: ${row['total_payment']}</p> </div>
            </div>
            <div class="row mt-1">
                <div class="col"> <p style="color: green">Payment Method: ${row['payment_method']}</p> </div>
            </div>
EOL;

	}

	CloseCon($conn);

?>