<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>KTRVS - Login</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" method="POST">
				<div class="control-group normal_text">
                  <!-- <h3><img src="img/logo.png" alt="Logo" /></h3> -->
                  <h3>QA Login</h3>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="email" id="email" name="email" placeholder="Email Address" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" name="login" id="login" class="btn btn-success" value="Login"/></span>
                </div>
                <div>
                      <a href="register" class="text-warning" style="font-size:16px;"> Not yet registered? Create account</a><br>
                <a href="../" class="text-info" style="font-size:16px;">Lab Tech? Click Here</a>    
             </div>
            </form>

            
            <form id="recoverform" method="post" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" name="email" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" name="recover" id="recover" class="btn btn-info" value="Recover"/></span>
                </div>
            </form>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
    
     </body>

</html>
<?php
if (isset($_POST["login"])){

$email = $_POST['email'];
$pass = md5($_POST['password']);
if ($email && $pass){
include("../app/functions.php");	
	$query = mysqli_query($db, "SELECT * FROM qa WHERE email='$email'");
	$numrows = mysqli_num_rows($query);
	
	if ($numrows != 0){
		while ($row = mysqli_fetch_assoc($query))
            {
			$dbname = $row['email'];
			$dbpassword = $row['password'];
			}
		if ($email==$dbname){
			if ($pass==$dbpassword){
                if (!isset($_SESSION))
                {
                        session_start();
      
                }
                
                      $_SESSION['admin'] = $email;
                      $_SESSION['active'] = true;
                    echo "<script>window.open('../dashboard','_self')</script>";
           }else{
			$result = "Invalid Password";			
	        echo "<script>alert('$result')</script>";
		    }
			}else{
			$result = "Invalid Email";			
	        echo "<script>alert('$result')</script>";
		   			}
		}else{
			$result = "User not found";			
	        echo "<script>alert('$result')</script>";
		   
  	}
}
    else
    {
        	$result = "Please fill in the details both Details";			
           echo "<script>alert('$result')</script>";
		 }

}


    if (isset($_POST['recover']))
    {
    $email = $_POST['email'];
	$query = mysqli_query($db, "SELECT * FROM qa WHERE email='$email'");
	$numrows = mysqli_num_rows($query);
	if ($numrows != 0){
	$newpass = rand(0, 10000000);
	$head = "Password Recovery";
	$message = 
    "Dear User,<br> Your new password is $newpass.<br> Please login to change it.
	<br> Regards.";
	email($email,$message,$head);	
	$newpasshash =  md5($newpass);
	
	$insert = mysqli_query($db, "update qa set password='$newpasshash' where email='$email'");
	if ($insert){	
	echo "<script>alert('Password Changed, Check Your Mail For More Info')</script>";
	echo "<script>window.open('index','_self')</script>";
	}else{
	echo "<script>alert('Error, Try Again')</script>";
	}
	
	}else{
	echo "<script>alert('Invalid Details')</script>";
	}

    }
 
?>