<?php

    function OpenCon() {
		$dbhost = "localhost";
		$dbuser = "root";
		$dbpass = "rootroot";
		$db = "expense_tracking";
		
		$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn->error);

		return $conn;
	}
	
	function CloseCon($conn) {
		$conn->close();
    }
    
?>