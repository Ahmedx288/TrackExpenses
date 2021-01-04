<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
        } else {
            
            $item_no = $_POST['item_no'];
            
            $res = $conn->query("SELECT * FROM product;");
            
            echo "<div class='row mt-1 item-no-$item_no'>";

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
                    <div class="col-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">LE(£)</span>
                            </div>
                            <input type="number" inputmode="decimal" class="form-control unit-price" min="0" aria-label="Amount (to the nearest dollar)" required>
                        </div>
                    </div>

                    <div class="col">
                        <input type="number" class="form-control unit-quantity" min="0" required>
                    </div>

                    <div class="col">
                        <input type="number" inputmode="decimal" class="form-control unit-discount" value="0" min="0" required>
                    </div>

                    <div class="col-2">
                        <input type="number" inputmode="decimal" class="form-control unit-total" placeholder="xx.xx$" readonly>
                    </div>'
                ;

            echo '</div>';
        }
        
	CloseCon($conn);

?>