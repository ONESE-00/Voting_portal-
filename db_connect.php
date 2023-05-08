<?php
	session_start();
	
	//connect to the DB 	$db_connect=mysqli_connect(server,username,password,DB)
	
	$db_connect=mysqli_connect('localhost','admin','kirinyaga','voting');
	$_SESSION['$db_connect'] = $db_connect;

	//check whether the DB connection was successful 
	if (!$db_connect){
		echo 'DATABASE CONNECTION FAILURE'.mysqli_connect_error();

			}
/*else {echo "<p style='color:green'>Database connection succesful..</p>";}*/
?>

