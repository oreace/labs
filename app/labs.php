<?php 
require_once('functions.php');

$action = "";
$response = "";
$output = "";
$array = array();
if (isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
  @$action = $_POST['action'];
}






if ($action == "fetch")
{
$get = mysqli_query($db, "select * from lab");
$i = 1;
while ($row = mysqli_fetch_array($get))
{
        $result2 = array();
        $result2[] = $i;
        $result2[] = $row['name'];
        $result2[] = $row['address'];
        $result2[] = "<button type='button' class='btn btn-info view_team' id='".$row['name']."'>View</button>";
        $result2[] = "<button type='button' class='btn btn-primary view_subs' id='".$row['name']."'>View</button>";
        $result2[] = "<button type='button' class='btn btn-danger delete_lab' id='".$row['name']."'>Delete</button>";
       
        $output[] = $result2;
   $i++; }
    echo json_encode($output);



}



if ($action == "view_team")
{
 $lab = $_POST['name'];
$query = "select * from team where lab='$lab'";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0)
{
  $i = 1;
   $output .= 
    "
    <table class='table'>
    <tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Type</th>
    </tr>
    ";

    while($row = mysqli_fetch_array($result))
    {
        $name = $row['name'];
        $email = $row['email'];
        $gsm = $row['gsm'];
        $address = $row['address'];
        $type = $row['type'];
        $output .= 
        "
        <tr>
        <td>$i</td>
        <td>$name</td>
        <td>$email</td>
        <td>$gsm</td>
        <td>$address</td>
        <td>$type</td>
        </tr>
        ";
        
      $i++; }
   $output .= "</table>"; 

    echo $output;

}

}


if ($action == "view_subs")
{
    $lab = $_POST['name'];
$get = mysqli_query($db, "select * from subs where lab='$lab' order by id desc");
$count = mysqli_num_rows($get);
if ($count != 0)
{
   $response .= 
    "
    <table class='table'>
    <tr>
    <th>#</th>
    <th>Event</th>
    <th>Start Date</th>
    <th>End Date</th>
    </tr>
    ";
    $i = 1;
    while($row = mysqli_fetch_array($get))
    {$r = $row['sub'];
    $query =  mysqli_query($db, "select * from cycle where id='$r'");
    while($rows = mysqli_fetch_array($query))
    {
       $name = $rows['name'];
       $startdate = $rows['startdate'];
       $enddate = $rows['enddate'];
        $response .=
        "
        <tr>
        <td>$i</td>
        <td>$name</td>
        <td>$startdate</td>
        <td>$enddate</td>
        </tr>
        ";
    $i++;}    
    }
   $response .= "</table>"; 
}
else
{
    $response = "<h3>No Subscriptions yet</h3>";
}
echo $response;

}

if ($action == "delete_lab")
{
    $lab = $_POST['name'];
    $query1 = mysqli_query($db, "delete from subs where lab='$lab'");
    $query2 = mysqli_query($db, "delete from team where lab='$lab'");
    $query3 = mysqli_query($db, "delete from lab where name='$lab'");
    if ($query1 && $query2 && $query3)
    {
        $response = "success";
    }
    else
    {
        $response = "Try again";
    }
    echo $response;
}

?>