<?php
	//session_start();	
	
	//Require the database connection page...use the include() or require()
	require("db_connect.php");
	require("my_functions.php");
	
	//PICK USER DETAILS FROM THE FORM 
	if(isset($_POST['login'])){
	
		//creating var to hold the form data
		$email = $mail = $pass = $password = ' ';
		
		$error = array('password'=>' ','email'=>' ');

		$mail = $_POST['email'];
		$pass = $_POST['password'];
		
		//sanitize the data using the function we created in my_functions.php
		//$email = sanitize('$mail');
		//$password = sanitize('$pass');
		
		
		//hash the password
		$password = crypt($pass,'joga_bonito');
		
		//echo "<p style='color:white'>$email,$password</p>";
		//Retrieve the data
		$sql = " SELECT * FROM user WHERE Email = '$mail' ";
		
		//execute the sql statement
		$result = mysqli_query($db_connect,$sql);
		
		//fetch the results..this f() fetches a result row as an associative row
		$user = mysqli_fetch_assoc($result);
		
		$password_from_db = $user['Password'];
		echo "<p style = 'color:red' >$mail,$password</p>";
		echo  $user['Email'],' ',$user['Password'];
		
		
		if($password == $password_from_db){
			
			$error['password'] = "<p style='color:green;text-align:center;'>SUCCESSFUL LOGIN</p>";
			
			//save some user info on a session
			$_SESSION['Firstname'] = $user['Firstname'] ;
			$_SESSION['Othernames'] = $user['Othernames'] ;
			$_SESSION['Id'] = $user['Id'] ;
			$_SESSION['Email'] = $user['Email'] ;
			$_SESSION['Password'] = $user['Password'] ;
			$_SESSION['Contact'] = $user['Contact'] ;
			
			//REDIRECT USER TO THE MAIN PAGE
			header('Location: index.php');
		
			}
		else{
			$error['password']= "<p style='color:red'>WRONG USERNAME OR PASSWORD.TRY AGAIN!!</p>";
			$error['email'] = $mail;
			
		}
		
		//free memory 
		//mysqli_free_result($result);
		//close the DB connection 
		//mysqli_close($db_connect);
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login Here</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- forms CSS
		============================================ -->
    <link rel="stylesheet" href="css/form/all-type-forms.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="color-line"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="back-link back-backend">
                    <a href="index.html" class="btn btn-primary">Back to HOME</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div class="text-center m-b-md custom-login">
                    <h3>PLEASE LOGIN TO APP</h3>
                    <p>This is the best app ever!</p>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method='POST' id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="email">Email Address</label>
                                <input type="email" placeholder="example@gmail.com" title="Please enter you username" required name="email" id="email" class="form-control">

                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" required  name="password" id="password" class="form-control">
                                  <!-- <?php if(isset($error['password'])){echo $error['password'];}if(isset($error['email'])){echo "<br>",$error['email'];}echo $mail;?> -->

                            </div>
                            <div class="checkbox login-checkbox">
                                <label>

                                
                            </div>
                            <input type='submit' id='login' name='login' value='Login' class="btn btn-success btn-block loginbtn">
                            <a class="btn btn-default btn-block" href="Signup.php">Register</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <p>Copyright © 2018 <a href="https://colorlib.com/wp/templates/">Colorlib</a> All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.11.3.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/jquery.meanmenu.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- sticky JS
		============================================ -->
    <script src="js/jquery.sticky.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- tab JS
		============================================ -->
    <script src="js/tab.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
</body>

</html>
