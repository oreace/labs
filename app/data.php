<?php
require_once('functions.php');
$action = "";
$response = "";
$array = array();
if (isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    $action = $_POST['action'];
}

if($action == "login")
{
if (!isset($_SESSION))
{
    session_start();
}
$email = $_POST['email'];
$pass = $_POST['password'];
$passhash = crypt($pass, $email);
	
$get = mysqli_query($db, "select * from team where email='$email' and password='$passhash'");
$count = mysqli_num_rows($get);
    if ($count == 1)
    {
    $row = mysqli_fetch_array($get);
    $type = $row['type'];
    if ($type == "lead")
    {
        $_SESSION['lead'] = $email;
    }
    else
    {
        $_SESSION['standard'] = $email;
    }    
    $_SESSION['active'] = true;
    $response = "success";

    }
    else
    {
        $response = "Error, Check Details and Try Again";
    }
 echo $response;   
}

if ($action == "register")
{

    $name_lab = $_POST['name_lab'];
    $address_lab = $_POST['address_lab'];

    
    $check_lab = mysqli_query($db, "select * from lab where name='$name_lab'");
    $count_lab = mysqli_num_rows($check_lab);
    if ($count_lab == 0 )
    {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gsm = $_POST['gsm'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($password == $cpassword)
    {
    $check = mysqli_query($db, "select * from team where email='$email'");
    $count = mysqli_num_rows($check);
    if ($count == 0)
    {
        $query = mysqli_query($db, "insert into lab (name, address) values ('$name_lab','$address_lab')");
        if ($query)
        {
            $pass = crypt($password, $email);
            $re = "insert into team (name, email, gsm, address, lab, password, type) values ";
            $re .= "('$name','$email','$gsm','$address','$name_lab','$pass', 'lead')";
            $in = mysqli_query($db, $re);   
            $response = "success";
        }
        else
        {
            $response = "Some error occured, Please try again";
        }
        
    
    
    }
    else
        {
            $response = "Email already in Use";
        }
     
    }
    else
    {
        $response = "Passwords do not match";
    }
   
}
    else
    {
        $response = "Lab already registered";
    }
    echo $response;
}
?>