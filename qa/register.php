<?php 
include("../app/functions.php");	
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>KTRVS - Registration</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">          
            
             <form id="registerform" class="form-vertical" method="POST">
                <div class="control-group normal_text">
                  <h3>Create Account</h3>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" id="name"  name="name" placeholder="Name" />
                        </div>
                    </div>
                </div>
              
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-envelope"> </i></span><input type="email" id="email"  name="email" placeholder="Email Address" />
                        </div>
                    </div>
                </div>
    
      <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-envelope"> </i></span><input type="number" id="gsm"  name="gsm" placeholder="Phone Number" />
                        </div>
                    </div>
                </div>
      <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-envelope"> </i></span><input id="address"  name="address" placeholder="Address" />
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
                    <span class="pull-left">Already registered? <a href="index">Log In</a></span>
                    <span class="pull-right flip-link"><input type="submit" class="btn btn-success" name="register1" id="register1" value="Next >>"/></span>
                </div>
                
            </form>
         
            
        </div>
        
         <script src="js/jquery.min.js"></script>  
         <script src="js/matrix.login.js"></script> 
       </body>

</html>
<?php
if (isset($_POST["register1"])){
$email = $_POST['email'];
$pass = md5($_POST['password']);
$gsm = $_POST['gsm'];
$address = $_POST['address'];
$name = $_POST['name'];
    if ($email !='' && $pass !=''){
    $checkmail = mysqli_num_rows(mysqli_query($db, "select * from qa where email='$email'"));
	    if ($checkmail == 0 ){
		$insert = "insert into qa (name,email,gsm,address,password) values ('$name','$email','$gsm','$address','$pass')";
		$run = mysqli_query($db, $insert);
		if ($run){
                   if (!isset($_SESSION))
                {
                        session_start();
      
                }
                
         
  		      $_SESSION['admin'] = $email;
              $_SESSION['active'] = true;  
              echo "<script>window.open('../dashboard','_self')</script>";
           
              	}else{
 	        $result = "Failed, try again";			
	        echo "<script>alert('$result')</script>";
				}
        }else{
    	    $result = "Mail Already Exists, Please try another";			
	    echo "<script>alert('$result')</script>";
			}
    }
    else
    {
        $result = "Please Fill in both details";
    echo "<script>alert('$result')</script>";
		
    }

}



?>