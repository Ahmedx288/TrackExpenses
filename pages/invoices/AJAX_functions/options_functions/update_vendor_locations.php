<?php

	require "../../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {

        $vendor_id = $_POST['vendor_id'];

        $res = $conn->query("SELECT * FROM location
                             WHERE vendor_id = $vendor_id;");
        
        echo '<option hidden disabled selected value=""> -- Select a Location -- </option>';
        while($row = $res->fetch_assoc()) {
            echo "<option value=" . $row["id"] . ">" . $row['address'] . "</option>";
        }
        
	}

	CloseCon($conn);

?>