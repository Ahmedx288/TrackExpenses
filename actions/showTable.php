<?php
	require 'establish_close_connection.php';

	$username_id = $_POST['name'];
	$res = "";

	$conn = OpenCon();

	if (mysqli_connect_error()){
		die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
	} else {
		if(!empty($username_id)){

			if(is_numeric($username_id)) {
				$username_id = (int) $username_id;
				$res = $conn->query("SELECT * FROM customer WHERE id=${username_id};");
			} else {
				$res = $conn->query('SELECT * FROM customer WHERE name_=' . '"' . $username_id . '";');
			}
			 
			echo '<h2>Basic HTML Table</h2>';
			  
			if ($res->num_rows > 0){
				echo '<table border = "1">';
				echo '<tr> <th>id</th> <th>name_</th> <th>grade</th> </tr>';

				while($row = $res->fetch_assoc()) {
					echo '<tr>';

					echo '<td>' . $row['id'] . "</td>";
					echo '<td>' . $row['name_'] . "</td>";

					echo '</tr>';
				}
			} else {
				echo "Error: ". $sql . " " . $conn->error;
			}
			
			echo '</table>';
		} else {
			echo "Error, no information has been entered.";
		}
	}


	CloseCon($conn);

?>