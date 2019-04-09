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
$output = array();
$get = mysqli_query($db, "select * from cycle order by startdate desc");
$i = 1;
$id = '';    
while ($row = mysqli_fetch_array($get))
{
    $status = '';
    $enddate = $row['enddate'];
    $startdate = $row['startdate'];
    $date = date("Y-m-d");
    if ($enddate < $date)
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
    $id = $row['id'];
    $query = "select * from subs where lab='$lab' and sub='$id'";
    $result = mysqli_query($db, $query);
    $rows = mysqli_num_rows($result);
    //$sub = $rows['sub'];
    $date = $row['startdate'];
    $year = date("Y", strtotime($date));
    $result2 = array();
    if ($rows == 1 || $rows == i)
     {
        $result2[] = $i;
        $result2[] = $row['name'];
        $result2[] = $row['startdate'];
        $result2[] = $row['enddate'];
        $result2[] = $status;
        $result2[] = "<button type='button' class='btn btn-info view_report' id='".$row['name']."' name='".$year."'>View</button>";
        $result2[] = "<button type='button' class='btn btn-primary download' id='".$row['name']."' name='".$year."'>Download</button>";
       }

        $output[] = $result2;
    $i++; }
    echo json_encode($output);
}





if ($action == "show")
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

    $response = "";
    $response .= 
    "
    <table class='table'>
    <tr>
    
    <th>Sample</th>
    <th>Result</th>
    <th>SDI</th>
    <th>Grade</th>
    <th>Mean</th>
    <th>SD</th>
    <th>Accepted Range</th>
    </tr>
    ";

    $i = 1;
    $mean = 0.00000;
    $min = 0;
    $max = 0;
    $sd = 0.000000;
    $sdi = 0.00000;
    $grade = '';
    $name = $_POST['cycle'];
    $year = $_POST['year'];

    $get = mysqli_query($db, "select * from data where lab='$lab'");
    while($row = mysqli_fetch_array($get)){
        $p_id = $row['parameter'];
    
        $getter = mysqli_query($db, "select * from parameter where id='$p_id'");
        $rowwer = mysqli_fetch_array($getter);
        $parameter = $rowwer['name'];
        $response .= 
        "
        <tr>
        <td colspan='7'><h3>$parameter</h3></td>
        </tr>
        ";
      
        $get_samples = mysqli_query($db, "select * from samples where cycle='$name' and YEAR(datesent)='".$_POST['year']."'");
        while($row = mysqli_fetch_array($get_samples))
        {
        $sample_name = $row['name'];
        $sample_result = $row['result'];
    
        
        $sam = mysqli_query($db, "select * from lab_results where lab='$lab' and cycle='$name' and sample='$sample_name' and YEAR(datesent)='".$_POST['year']."'");
        $row = mysqli_fetch_array($sam);
        $re = $row['result'];
        $parameter = $row['parameter'];

        $pas = $rowwer['id'];

            $lim = mysqli_query($db, "select * from limits where cycle='$name' and sample='$sample_name' and parameter='$p_id'");
            $lims = mysqli_fetch_array($lim);
            $min = $lims['min'];
            $max = $lims['max'];
            if ($re >= $min && $re <= $max)
            {
                $grade = "ACC";
            }
            else
            {
                $grade = "UNACC";
            }
            $mean = ($max  + $min) /2;
            $var = (abs($max - $mean)^2) + (abs($min - $mean)^2);
            $sd = round(sqrt($var), 2);

            $sdi = round(($re - $mean)/$sd, 2);
         
            $response .= 
            "
            <tr>
            <td>$sample_name</td>
            <td>$re</td>
            <td>$sdi</td>
            <td>$grade</td>
            <td>$mean</td>
            <td>$sd</td>
            <td>$min - $max<td>
            </tr>
            ";


        }
        $response .= "
        <tr>
        <td colspan='7'> </td>
        </tr>";
        

            $i++;}
echo $response;

}



if ($action == "download")
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

    $s = $_POST['cycle'];
$response = 
"
<h2>Klinchex Test Result Verifier Services - Report</h2>
<table>
<tr>
<td>Participant</td>
<td>$lab</td>
</tr>
<tr>
<td>Subscription</td>
<td>$s</td>
</tr>

</table>
";

    $response .= 
    "
    <table>
    <tr>
    <th>Sample</th>
    <th>Result</th>
    <th>SDI</th>
    <th>Grade</th>
    <th>Mean</th>
    <th>SD</th>
    <th>Accepted Range</th>
    </tr>
    ";

    $i = 1;
    $mean = 0.00000;
    $min = 0;
    $max = 0;
    $sd = 0.000000;
    $sdi = 0.00000;
    $grade = '';
    $name = $_POST['cycle'];
    $year = $_POST['year'];

    $get = mysqli_query($db, "select * from data where lab='$lab'");
    while($row = mysqli_fetch_array($get)){
        $p_id = $row['parameter'];
    
        $getter = mysqli_query($db, "select * from parameter where id='$p_id'");
        $rowwer = mysqli_fetch_array($getter);
        $parameter = $rowwer['name'];
        $response .= 
        "
        <tr>
        <td><b>$parameter</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        ";
      
        $get_samples = mysqli_query($db, "select * from samples where cycle='$name' and YEAR(datesent)='".$_POST['year']."'");
        while($row = mysqli_fetch_array($get_samples))
        {
        $sample_name = $row['name'];
        $sample_result = $row['result'];
    
        
        $sam = mysqli_query($db, "select * from lab_results where lab='$lab' and cycle='$name' and sample='$sample_name' and YEAR(datesent)='".$_POST['year']."'");
        $row = mysqli_fetch_array($sam);
        $re = $row['result'];
        $parameter = $row['parameter'];

        $pas = $rowwer['id'];

            $lim = mysqli_query($db, "select * from limits where cycle='$name' and sample='$sample_name' and parameter='$p_id'");
            $lims = mysqli_fetch_array($lim);
            $min = $lims['min'];
            $max = $lims['max'];
            if ($re >= $min && $re <= $max)
            {
                $grade = "ACC";
            }
            else
            {
                $grade = "UNACC";
            }
            $mean = ($max  + $min) /2;
            $var = (abs($max - $mean)^2) + (abs($min - $mean)^2);
            $sd = round(sqrt($var), 2);

            $sdi = round(($re - $mean)/$sd, 2);
         
            $response .= 
            "
            <tr>
            <td>$sample_name</td>
            <td>$re</td>
            <td>$sdi</td>
            <td>$grade</td>
            <td>$mean</td>
            <td>$sd</td>
            <td>$min - $max<td>
            </tr>
            ";


        }
        
            $i++;}
                $response .= "</table>";

echo $response;


}


?>