<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $main = $_POST['main'];
        $sub = $_POST['sub'];

        $res = $conn->query("INSERT INTO category (main_category, sub_category) 
                             VALUES (\"$main\", \"$sub\");");
        
        if ($res) {
            print"  <div class='alert alert-success' role='alert'>
                        The product category \"${main}: ${sub}\" has been successfully added.
                    </div>";
        } else if ($conn->error == "Duplicate entry '${main}-${sub}' for key 'main_category'"){
            print"  <div class='alert alert-warning' role='alert'>
                        The product category \"${main}: ${sub}\" is already exists.
                    </div>";
            
        }else {
            print"  <div class='alert alert-danger' role='alert'>
                        echo 'Error: ' . $conn->error;
                    </div>";
        }


	}


	CloseCon($conn);

?>