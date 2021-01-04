<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $vendor_name = $_POST['vendor_name'];
        $vendor_id = $_POST['vendor_id'];
        $new_location = $_POST['new_location'];
        $city = $_POST['city'];
        $notes = $_POST['address_notes'];

        $res = $conn->query("INSERT INTO location (vendor_id, address, city, address_notes)
                             VALUES ($vendor_id, '$new_location', '$city', '$notes');");
        
        if ($res) {
            print"  <div class='alert alert-success' role='alert'>
                        The new location \"${new_location}\" for \"${vendor_name}\" has been successfully added.
                    </div>";
        } else if ($conn->error == "Duplicate entry '$vendor_id-$new_location' for key 'vendor_id'"){
            print"  <div class='alert alert-warning' role='alert'>
                        The location \"${new_location}\" for \"${vendor_name}\" is already exists.
                    </div>";
            
        }else {
            print"  <div class='alert alert-danger' role='alert'>
                        Error: $conn->error;
                    </div>";
        }


	}


	CloseCon($conn);

?>