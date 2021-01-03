<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {

        $first_name = $_POST['fName'];
        $last_name = $_POST['lName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        $res = $conn->query("INSERT INTO customer (first_name, last_name, age, gender)
                             VALUES (\"$first_name\",\"$last_name\", $age, '$gender');");
        
        if ($res) {
            print"  <div class='alert alert-success' role='alert'>
                        The customer \"${first_name} ${last_name}\" has been successfully added.
                    </div>";
        } else if ($conn->error == "Duplicate entry '${first_name}-${last_name}' for key 'first_name'"){
            print"  <div class='alert alert-warning' role='alert'>
                        The customer \"${first_name} ${last_name}\" is already exists.
                    </div>";
            
        }else {
            print"  <div class='alert alert-danger' role='alert'>
                        echo 'Error: ' . $conn->error;
                    </div>";
        }


	}


	CloseCon($conn);

?>