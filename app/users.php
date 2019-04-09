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


if ($action == "insert")
{
   if (!isset($_SESSION))
   {
       session_start();
   } 
   $user = "";
   if (isset($_SESSION['lead']))
    {
        $user = $_SESSION['lead'];
    }
    else
    {
        $user = $_SESSION['standard'];
    }
    $need = mysqli_query($db, "select * from team where email='$user'");
    $it = mysqli_fetch_array($need);
    $lab = $it['lab'];



   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gsm = $_POST['gsm'];
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $password = $_POST['password'];
    
    $check = mysqli_query($db, "select * from team where email='$email'");
    $count = mysqli_num_rows($check);
    if ($count == 0)
    {
            $pass = crypt($password, $email);
            $re = "insert into team (name, email, gsm, address, lab, password, type) values ";
            $re .= "('$name','$email','$gsm','$address','$lab','$pass', 'standard')";
            $in = mysqli_query($db, $re);   
        if ($in)
        {
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
     
    
   
    echo $response;
}




if ($action == "fetch")
{
   if (!isset($_SESSION))
   {
       session_start();
   } 
   $user = "";
   if (isset($_SESSION['lead']))
    {
        $user = $_SESSION['lead'];
    }
    else
    {
        $user = $_SESSION['standard'];
    }
    $need = mysqli_query($db, "select * from team where email='$user'");
    $it = mysqli_fetch_array($need);
    $lab = $it['lab'];
$query = "select * from team where lab='$lab'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0)
{
  $i = 1;
    while($row = mysqli_fetch_array($result))
    {

        $result2 = array();
        $result2[] = $i;
        $result2[] = $row['name'];
        $result2[] = $row['email'];
        $result2[] = $row['gsm'];
        $result2[] = $row['address'];
        $email = $row['email'];
        if ($user == $email)
        {
        $result2[] = "<button type='button' class='btn btn-default' id='".$row['id']."'>Edit</button>";
        $result2[] = "<button type='button' class='btn btn-default' id='".$row['id']."'>Delete</button>";
        }else
        {
        $result2[] = "<button type='button' class='btn btn-info edit_user' id='".$row['id']."'>Edit</button>";
        $result2[] = "<button type='button' class='btn btn-danger delete_user' id='".$row['id']."'>Delete</button>";
        }
        $output[] = $result2;
   $i++; }
    echo json_encode($output);

}

}


if ($action == "delete")
{
   $id = $_POST['id'];
    $query = "delete from team where id='$id'";
    $up = mysqli_query($db, $query);
    if ($up)
    {
        $response = "success";
    }
    else
    {
        $response = "Error, Try Again";
    }
echo $response;
}

if($action == "update_lab")
{
    $lab = $_POST['lab'];
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $query = mysqli_query($b, "update lab set address='$address' where name='$lab'");
    if ($query)
    {
        $response = "success";
    }
    else
    {
        $response = "some error occured, try again";
    }
    echo $response;
}

if ($action == "fetch_single")
{
    $id = $_POST['id'];
    $get = mysqli_query($db, "select * from team where id='$id'");
    $row = mysqli_fetch_array($get);
    $result = array();
    $result['name']  = $row['name'];
    $result['email'] = $row['email'];
    $result['gsm'] = $row['gsm'];
    $result['address'] = $row['address'];
    $result['password'] = $row['password'];

    echo json_encode($result);

}

if ($action == "update")
{
    $user = $_POST['user'];
    $name = $_POST['name'];
    $gsm = $_POST['gsm'];
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $pass = "";
    if (isset($_POST['password']) && isset($_POST['password']) != "")
    {
        $password = $_POST['password'];
        $pass = crypt($password, $user);
    }
    else
    {
        $pass = $_POST['pass'];
    }

    $query = "update team set name='$name', gsm='$gsm', address='$address', gsm='$gsm' where email='$user'";
    if (mysqli_query($db, $query))
    {
        $response = "success";
    }
    else
    {
        $response = "Error updating";
    }
    echo $response;
}

if ($action == "update_admin")
{
    $user = $_POST['user'];
    $name = $_POST['name'];
    $gsm = $_POST['gsm'];
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $pass = "";
    if (isset($_POST['password']) && isset($_POST['password']) != "")
    {
        $password = $_POST['password'];
        $pass = crypt($password, $user);
    }
    else
    {
        $pass = $_POST['pass'];
    }

    $query = "update qa set name='$name', gsm='$gsm', address='$address', gsm='$gsm' where email='$user'";
    if (mysqli_query($db, $query))
    {
        $response = "success";
    }
    else
    {
        $response = "Error updating";
    }
    echo $response;
}

?>