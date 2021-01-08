<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
        } else {
            
            $item_no = $_POST['item_no'];
            
            $res = $conn->query("SELECT * FROM product;");
            
            echo "<div class='row mt-1'>";

                echo '<div class="col-1">';
                    echo '<button type="button" class="btn btn-secondary remove-invoice-item">-</button>';
                echo '</div>';

                echo '<div class="col-3">';
                    echo "<div class='dummy'> <!--positioning error message-->";
                        echo "<select type='text' class='form-control unit-item' id='item-no-${item_no}' name='item-no-${item_no}' required>";
                                echo '<option hidden disabled selected value=""> -- Select an Item -- </option>';
                            while($row = $res->fetch_assoc()) {
                                echo "<option value=" . $row["id"] . ">" . $row['name_'] . "</option>";
                            }
                        echo '</select>';
                    echo '</div>';
                echo '</div>';

                print "
                    <div class='col-3'>
                        <div class='input-group mb-3'>
                            <div class='input-group-prepend'>
                                <span class='input-group-text'>LE(£)</span>
                            </div>
                            <input type='number' inputmode='decimal' class='form-control unit-price'
                                value='1' min='0' aria-label='Amount (to the nearest LE)' name='price-of-item${item_no}' required>
                        </div>
                    </div>

                    <div class='col'>
                        <input type='number' class='form-control unit-quantity' 
                            value='1' min='1' name='quantity-of-item${item_no}' required>
                    </div>

                    <div class='col'>
                        <input type='number' inputmode='decimal' class='form-control unit-discount'
                            value='0' min='0' name='discount-of-item${item_no}' required>
                    </div>

                    <div class='col-2'>
                        <div class='dummy'> <!--positioning error message-->
                            <input type='number' inputmode='decimal' class='form-control unit-total-price' 
                                name='unit${item_no}-total-price' value='0' min='0.5' readonly required>
                        </div>
                    </div>"
                ;

            echo '</div>';
        }
        
	CloseCon($conn);

?>