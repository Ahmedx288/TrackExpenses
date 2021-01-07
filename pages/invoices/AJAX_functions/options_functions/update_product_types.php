<?php

	require "../../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {
        
        $res = $conn->query("SELECT * FROM category;");
        
        while($row = $res->fetch_assoc()) {
            echo "<option value=" . $row["id"] . ">" . $row['main_category'] . ": " . $row['sub_category'] . "</option>";
        }

	}

	CloseCon($conn);

?>