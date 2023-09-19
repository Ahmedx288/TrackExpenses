<?php

    require_once("../../../assets/establish_close_connection.php");

	$conn = OpenCon();

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
        } else {
            
            $customer_id = $_POST['customer_id'];
            $vendor_id = $_POST['vendor_id'];
            
            $res = $conn->query("call create_invoices_overview($customer_id, $vendor_id);");
            
            while($row = $res->fetch_assoc()){

                echo "<div class='row mt-1'>";

                    echo '<div class="col-1">';
                        echo "<p>" . $row['ID'] ."</p>";
                    echo '</div>';

                    echo '<div class="col-2">';
                        echo "<p>" . $row['BuyerF'] . " " . $row['BuyerL'] . "</p>";
                    echo '</div>';

                    echo '<div class="col-2">';
                        echo "<p>" . $row['Store'] . "</p>";
                    echo '</div>';

                    echo '<div class="col">';
                        echo "<p>" . $row['Type'] ."</p>";
                    echo '</div>';

                    echo '<div class="col-2">';
                        echo "<p>" . $row['DATE'] . "</p>";
                    echo '</div>';

                    echo '<div class="col-2">';
                        echo "<p>" . $row['TIME'] . "</p>";
                    echo '</div>';

                    echo '<div class="col">';
                        echo '<button type="button" class="btn btn-primary btn-block more-on-invoice"
                                data-toggle="modal" data-target="#modal-invoice-details">!</button>';
                    echo '</div>';

                echo "</div>";

            }
        }
        
	CloseCon($conn);
