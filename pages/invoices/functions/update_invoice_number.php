<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {

        $res = $conn->query("SELECT MAX(id) FROM invoice;");
        
        echo $res->fetch_assoc()['MAX(id)'] + 1;

	}

	CloseCon($conn);

?>