<?php

	require "../../../assets/establish_close_connection.php";

	$conn = OpenCon();

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
    } else {

        $res = $conn->query("SELECT * FROM customer;");
        echo '<option hidden disabled selected value=""> -- Select a Customer -- </option>';
        while($row = $res->fetch_assoc()) {
            echo "<option value=" . $row["id"] . ">" . $row['first_name'] . " " . $row['last_name'] . "</option>";
        }

	}

	CloseCon($conn);

?>