<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $type = $_POST['new_type'];

        $res = $conn->query("INSERT INTO invoice_type (type_) VALUES (\"" . $type . "\");");
        
        if ($res) {
            print"  <div class='alert alert-success' role='alert'>
                        The invoice type \"${type}\" has been successfully added.
                    </div>";
        } else if ($conn->error == "Duplicate entry '$type' for key 'type_'"){
            print"  <div class='alert alert-warning' role='alert'>
                        The invoice type \"${type}\" is already exists.
                    </div>";
            
        }else {
            print"  <div class='alert alert-danger' role='alert'>
                        echo 'Error: ' . $conn->error;
                    </div>";
        }


	}


	CloseCon($conn);

?>