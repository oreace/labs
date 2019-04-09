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
    $name = $_POST['name'];
    $startdate = mysqli_real_escape_string($db, $_POST['startdate']);
    $enddate = mysqli_real_escape_string($db, $_POST['enddate']);

    $cycle = mysqli_query($db, "insert into cycle (name,startdate,enddate) values ('$name','$startdate','$enddate')");

    for($i=1; $i<=5; $i++)
    {
      $sa = "sample".$i;
      $re = "result".$i;
      $de = "desc".$i;
      $sample= $_POST[$sa];
      $result= $_POST[$re];
      $desc = mysqli_real_escape_string($db, $_POST[$de]);
      $samples= mysqli_query($db, "insert into samples (cycle,name,result,description) values ('$name','$sample','$result','$desc')");
    }
    if ($cycle && $samples)
    {
      $response = "success";
      $_SESSION['cycle'] = $name;  
    }
    else
    {
        $response = "some error occured, please try again";
    }
echo $response;
}

if ($action == "fetch")
{
$get = mysqli_query($db, "select * from cycle order by startdate desc");
$i = 1;
while ($row = mysqli_fetch_array($get))
{
    $status = '';
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
  
  
        $result2 = array();
        $result2[] = $i;
        $result2[] = $row['name'];
        $result2[] = $row['startdate'];
        $result2[] = $row['enddate'];
        $result2[] = $status;
        $result2[] = "<button type='button' class='btn btn-info view' id='".$row['name']."' name='".date("Y", strtotime($row['startdate']))."'>View</button>";
        $result2[] = "<button type='button' class='btn btn-danger delete_cycle' id='".$row['name']."'>Delete</button>";
      $output[] = $result2;
   $i++; }
    echo json_encode($output);



}

if ($action == "delete")
{
    $id = $_POST['id'];
    $get = mysqli_query($db, "select * from cycle where id='$id'");
    $row = mysqli_fetch_array($get);
    $name = $row['name']; 
    $year = date("Y", strtotime($row['startdate']));
    
    $query = mysqli_query($db, "delete from cycle where id='$id'");
    $query2 = mysqli_query($db, "delete from samples where cycle='$name' and year(datesent) = '$year'");
if ($query && $query2)
    {
      $response = "success";
    }
    else
    {
        $response = "some error occured, please try again";
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