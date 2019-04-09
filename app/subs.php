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






if ($action == "fetch")
{
$get = mysqli_query($db, "select * from cycle where year(startdate) = year(now()) order by startdate desc");
$i = 1;
while ($row = mysqli_fetch_array($get))
{
    $status = '';
    $id = $row['id']; 
    $enddate = $row['enddate'];
    $startdate = $row['startdate'];
    $date = date("Y-m-d");
    if ($enddate < $date )
    {
    $status = "completed";
    }
    elseif ($startdate > $date)
    {
    $status = "Pending";
    }
    else
    {
    $status = "In Progress";
    }
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
    $query = mysqli_query($db, "select * from subs where lab='$lab' and sub='$id'");
    $count = mysqli_num_rows($query);
    
        $result2 = array();
        $result2[] = $i;
        $result2[] = $row['name'];
        $result2[] = $row['startdate'];
        $result2[] = $row['enddate'];
        $result2[] = $status;
       
        $result2[] = "<button type='button' class='btn btn-info view' id='".$row['name']."'>View</button>";

        $date = date("Y-m-d");
        if ($startdate > $date && $status == "Pending")
        {
   
        if ($count == 1)
        {
            $result2[] = "<button type='button' class='btn btn-primary unapply' id='".$row['id']."'>Unapply</button>";
        }
        else
        {
             $result2[] = "<button type='button' class='btn btn-primary apply' id='".$row['id']."'>Apply</button>";
        }
        }
        else
        {
            $result2[] = "Closed";
        }
        $output[] = $result2;
   $i++; }
    echo json_encode($output);



}




if ($action == "apply")
{
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
 
    $id = $_POST['id'];
    $if = mysqli_query($db, "select * from subs where lab='$lab' and sub='$id'");
    $check = mysqli_num_rows($if);
    if ($check == 0)
    {
    $query = "insert into subs (lab, sub) values ('$lab','$id')";
    $up = mysqli_query($db, $query);
    if ($up)
    {
        $response = "success";
    }
    else
    {
        $response = "Error, try Again";
    }
    }
    else
    {
        $response = "You already subscribed";
    }
echo $response;
}

if ($action == "unapply")
{
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
 
    $id = $_POST['id'];
    $query = "delete from subs where lab='$lab' and sub='$id'";
    $up = mysqli_query($db, $query);
    if ($up)
    {
        $response = "success";
    }
    else
    {
        $response = "Error, try Again";
    }
echo $response;
}


if ($action == "fetch_single")
{
    $id = $_POST['id'];
    $get = mysqli_query($db, "select * from samples where cycle='$id' and year(datesent) = year(curdate())");
$count = mysqli_num_rows($get);
if ($count != 0)
{
    $i =1;
    $response .= 
    "
    <table class='table'>
    <tr>
    <th>#</th>
    <th>Name</th>
    <th>Description</th>
    </tr>
    ";

    while($row = mysqli_fetch_array($get))
    {
        $name = $row['name'];
        $description = $row['description'];
        $response .= "<tr>
                    <td>$i</td>
                    <td>$name</td>
                    <td>$description</td>
                    </tr>";
    $i++;}

   $response .= "</table>"; 
}
else
{
    $response = "<h3>Empty</h3>";
}
echo $response;

}



?>