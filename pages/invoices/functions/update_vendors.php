<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        $res = $conn->query("SELECT * FROM vendor;");
        
        while($row = $res->fetch_assoc()) {
            echo "<option vlaue=" . $row["id"] . ">" . $row['name_'] . "</option>";
        }
        
	}


	CloseCon($conn);

?>