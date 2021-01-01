<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
        } else {
            $res = $conn->query("SELECT * FROM product;");
        
            echo '<div class="row mt-1">';

                echo '<div class="col-1">';
                    echo '<button type="button" class="btn btn-secondary remove-invoice-item">-</button>';
                echo '</div>';

                echo '<div class="col-3">';
                    echo '<select type="text" class="form-control" id="products">';

                        while($row = $res->fetch_assoc()) {
                            echo "<option vlaue=" . $row["id"] . ">" . $row['name_'] . "</option>";
                        }

                    echo '</select>';
                echo '</div>';

                print '
                    <div class="col-2">
                        <input type="number" inputmode="decimal" class="form-control" id="unit-price" placeholder="xx.xx$">
                    </div>

                    <div class="col-2">
                        <input type="number" class="form-control" id="unit-quantity">
                    </div>

                    <div class="col-2">
                        <input type="number" inputmode="decimal" class="form-control" id="unit-discount" placeholder="xx.xx$">
                    </div>

                    <div class="col-2">
                        <input type="number" inputmode="decimal" class="form-control" id="unit-total" placeholder="xx.xx$" disabled>
                    </div>'
                ;

            echo '</div>';
	    }


	CloseCon($conn);

?>