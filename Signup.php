<?php
	
	//Require the database connection page...use the include() or require()
	require("db_connect.php");
	require('my_functions.php');


if(isset($_POST['save'])){
	
	//creating var to hold the form data
	$firstname = $surname = $phonenumber = $email = $password ='';

	$firstname = $_POST['fname'];
	$surname = $_POST['sirname'];
	$phonenumber = $_POST['phonenum'];
	$email = $_POST['email_address'];
	$password = $_POST['pass'];
	$error = array('firstname' =>' ','surname'=>' ','phonenumber'=>' ','email'=>' ','password'=>' ','general'=>' ');
	$success='';
	
	//print the form data
	//echo "<p style='color:white;'>$firstname $surname $phonenumber $email $password</p> ";
	//echo 'SIGN UP FORM';
	
	//validating FIRST NAME
	if (empty($firstname)){
		$error['firstname'] = "<p style='color:red;'>PLEASE ENTER YOUR FIRST NAME</p> ";
		
	}
	else{
		$firstname = sanitize($firstname); #the input is always viewed as text and not as executable code. Used to prevent XSS
		
		//CHECK WHETHER SPECIAL CHARS HAVE BEEN USED 
		/*if (!preg_match('#^[ a-z ]+$/#i',$firstname)){
			$error['firstname'] = "<p style='color:red;'>PLEASE USE LETTERS a-z only</p> ";} */
			}
	
	//validating SURNAME
	if (empty($surname)){
		$error['surname'] = "<p style='color:red;'>PLEASE ENTER YOUR SURNAME</p> ";
	}
	else{
		$surname = sanitize($surname);
		//CHECK WHETHER SPECIAL CHARS HAVE BEEN USED 
		/* if (!preg_match('#^[ a-z ]+$/#i',$surname)){
			$error['surname'] = "<p style='color:red;'>PLEASE USE LETTERS a-z only</p> ";}*/
		
			
	}
	
	//validating PHONE NUMBER
	if (empty($phonenumber)){
		$error['phonenumber'] = "<p style='color:red;'>PLEASE ENTER YOUR PHONE NUMBER</p> ";
	}
	else{
		$phonenumber = sanitize($phonenumber);
		
		//check whether phonenumber is a number
		if (!is_numeric($phonenumber)){
			 $error['phonenumber'] ="<p style='color:red;'>PLEASE USE NUMBERS 0-9</p>";
			 }
		//verify the phonumber length is equal to 10
		if (strlen($phonenumber)!=10){
			echo "<p style='color:red;'>INVALID PHONE NUMBER LENGTH..MUST BE 10 DIGITS</p> ";
		}
	}
	
	//validating EMAIL ADDRESS
	if (empty($email)){
		$error['email'] = "<p style='color:red;'>PLEASE ENTER YOUR EMAIL ADDRESS</p> ";
	}
	else{
		$email= htmlspecialchars($email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  			echo "<p style='color:red;'>INVALID EMAIL ADDRESS($email)</p> ";
		} 
		
	}
	
	//validating PASSWORD
	if (empty($password)){
		$error['password'] = "<p style='color:red;'>PLEASE ENTER YOUR PASSWORD</p> ";
	}
	else{
		$password = sanitize($password);
		//function to validate password in terms of characters length etc
		$password = crypt($password,'joga_bonito');
		
	}	
	
	/*
	if (array_filter($error)){
		$error['general'] = "<p style='color:red;'>PLEASE SORT OUT THE ABOVE ERRORS BEFORE YOU CONTINUE</p> ";
	}
	else {}*/
	
		//if the login is successful save the data to the DB
		$sql = " INSERT INTO user(Firstname,Othernames,Contact,Email,Password) VALUES ('$firstname','$surname',$phonenumber,'$email','$password') ";
		
		//$result = mysqli_query($db_connect,$sql);
		//$user_data = mysqli_fetch_asoc($result)	
		//executing the sql statement.
		if ($db_connect->query($sql)){
			$success = "<p style='color:green;'>SUCCESSFUL SIGNUP.Now you can <a href='login.php'>Login</a></p> ";
				
				}
			else {
				$error['general'] = "<p style='color:red;'>Error:".$db_connect->error."</p>";
			}
		
	
	
	
}
mysqli_close($db_connect );	
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Glassmorphism login Form Tutorial in html css</title>
  

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: auto;
    width: 400px;
    margin-top: 70px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
input[type="submit"]{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}
//if the no is checked DO NOT DISPLAY THE SUBMIT BUTTON 
.no:checked ~ input[type='submit']{display:none;}

    </style>

</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" id="register">
        <h3>Sign up HERE</h3>

        <label for="fname">First Name</label>
        <input type="text" id="fname" name="fname" maxlength='15' value="<?php if (isset($firstname)){echo $firstname;}?>" required>
        <?php if (isset($error['firstname'])){ echo $error['firstname'];}?>
        <div id='fname_error' style="color:red"></div>
        
        <label for="sirname">Sir Name</label>
        <input type="text" id="sirname" name="sirname" required>
        <?php if (isset($error['surname'])){ echo $error['surname'];}?>
        
        <label for="phonenum">Phone number</label>
        <input type="number" id="phonenum" name="phonenum" placeholder="07xxxxxxxx" required>
        <?php if (isset($error['phonenumber'])){ echo $error['phonenumber'];}?>
        
        <label for="email_address">Email Address</label>
        <input type="email" id="email_address" name="email_address" autocomplete='off' required>
        <?php if (isset($error['email'])){ echo $error['email'];}?>

        <label for="pass">Password</label>
        <input type="password" id="pass" name="pass" required>
        <?php 
        	if (isset($error['password'])){ echo $error['password'];}
        	if (isset($success)){echo $success;}
        	if (isset($error['general'])){echo $error['general'];}
        
        
        ?>
        <p>Agree to our Privacy Policy</p>
        <label for='yes' >Yes</label>
        <input type='radio' name='policy' class='yes' id='yes'>
        <label for='no'>No</label>
        <input type='radio' name='policy' class='no' id='no'>

        <input type="submit" id="save" name="save" value="Signup" >
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
</body>
</html>
<!-- partial -->
  
</body>
</html>
