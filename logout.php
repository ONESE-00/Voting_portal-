<?php 
	session_start();
	
	//unset all session variables 	
	session_unset();
	
	//redirect user to the login page
	header('Location:login.php');
	
	//session_destroy();


?>
