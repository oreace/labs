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
  @$action = $_POST['action'];
}

if ($action == "insert")
{

$user = "";
  if (!isset($_SESSION))
   {
       session_start();
   } 

   if (isset($_SESSION['lead']))
    {
        $user = $_SESSION['lead'];
    }

    
$labs = mysqli_query($db, "select * from team where email='$user'");
$row = mysqli_fetch_array($labs);
$lab = $row['lab'];

$check =  mysqli_query($db, "select * from data where lab='$lab'");
$count = mysqli_num_rows($check);
if ($count == 0)
{
for ($i = 1; $i<=20; $i++)
{
  $par = "parameter".$i;
  $met = "method".$i;
  $in = "instrument".$i;
  $ma = "manufacturer".$i;
  $parameter = mysqli_real_escape_string($db, $_POST[$par]);
  $method = mysqli_real_escape_string($db, $_POST[$met]);
  $instrument = mysqli_real_escape_string($db, $_POST[$in]);
  $manufacturer = mysqli_real_escape_string($db, $_POST[$ma]);

  $insert = mysqli_query($db, "insert into data (parameter,manufacturer, method,instrument,lab) values ('$parameter','$manufacturer', '$method','$instrument','$lab')") ;
}

}else{
    for ($i = 1; $i<=20; $i++)
    {
      $par = "parameter".$i;
      $met = "method".$i;
      $in = "instrument".$i;
      $ma = "manufacturer".$i;
      $parameter = mysqli_real_escape_string($db, $_POST[$par]);
      $method = mysqli_real_escape_string($db, $_POST[$met]);
      $instrument = mysqli_real_escape_string($db, $_POST[$in]);
      $manufacturer = mysqli_real_escape_string($db, $_POST[$ma]);
    }     
    
    $id = 'id'.$i;
    if ($id != "id21")
    {
        $id = $_POST[$id];
        
    }
    $insert = mysqli_query($db, "update data set parameter='$parameter', manufacturer='$manufacturer', method='$method', instrument='$instrument' where id='$id' and lab='$lab'");
}


  if ($insert)
  {
   $output =  "success"; 
  }else
  {
  $output =  "Error, try again";
  }
  


echo $output;
}



if ($action == "fetch_method")
{
    $id = $_POST['id'];
    $get = mysqli_query($db, "select * from method where p_id='$id'");
    while ($row = mysqli_fetch_array($get))
    {
        $code = $row['code'];
        $name = $row['name'];
        echo "<option value='$code'>$name</option>";
    }

}



?>