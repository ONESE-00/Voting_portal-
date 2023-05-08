<?php
//connect to the DB $db_connect=mysqli_connect(server,username,password,DB)
$db_connect=mysqli_connect('localhost','admin','kirinyaga','voting');

//check whether the DB connection was successful 
if (!$db_connect){
	echo 'DATABASE CONNECTION FAILURE'.mysqli_connect_error();

}
/*else {echo "<p style='color:green'>Database connection succesful..</p>";}*/

//check whether the user is logged in 
if (!isset($_SESSION['Firstname'])){header('Location:login.php');}
?>

