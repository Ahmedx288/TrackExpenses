<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $new_vendor = $_POST['new_vendor'];
        $res = $conn->query("INSERT INTO vendor (name_) VALUES (\"" . $new_vendor . "\");");
        
        if ($res) {
            print"  <div class='alert alert-success' role='alert'>
                        The vendor \"${new_vendor}\" has been successfully added.
                    </div>";
        } else if ($conn->error == "Duplicate entry '$new_vendor' for key 'name_'"){
            print"  <div class='alert alert-warning' role='alert'>
                        The vendor \"${new_vendor}\" is already exists. Did you mean to add a new location?
                    </div>";
            
        }else {
            print"  <div class='alert alert-danger' role='alert'>
                        echo 'Error: ' . $conn->error;
                    </div>";
        }


	}


	CloseCon($conn);

?>