<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {

        $name = $_POST['pName'];
        $trade_mark = $_POST['pTradeMark'];
        $category = $_POST['pCategory'];
        $weight = $_POST['pWeight'];

        $res = $conn->query("INSERT INTO product (name_ , trade_mark, category_id, weight_liter)
                             VALUES ('$name','$trade_mark', $category, $weight);");
        
        if ($res) {
            print"  <div class='alert alert-success' role='alert'>
                        The product \"${name}\" has been successfully added.
                        <br>
                        The new product will show in new items added to the invoice, currently added choices will not be affected.
                    </div>";
        } else if ($conn->error == "Duplicate entry '${name}-${trade_mark}' for key 'name_'"){
            print"  <div class='alert alert-warning' role='alert'>
                        The product \"${name}\" is already exists.
                    </div>";
            
        }else {
            print"  <div class='alert alert-danger' role='alert'>
                        Error: $conn->error;
                    </div>";
        }


	}


	CloseCon($conn);

?>