<?php
	//session_start();
	//require('db_connect.php');

	//function to sanitize user-data
	function sanitize($data){
	
		$data = htmlspecialchars($data);
		$data = mysqli_real_escape_string($_SESSION['$db_connect'],$data);
		
		return $data;
	}

?>
