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
$sample = $_POST['sample'];
if (!empty($sample))
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
    else
    {
        $user = $_SESSION['standard'];
    }
 
$labs = mysqli_query($db, "select * from team where email='$user'");
$row = mysqli_fetch_array($labs);

$lab = $row['lab'];
$cycle = $_POST['cycle'];
for ($i = 1; $i<=20; $i++)
{
  $par = "parameter".$i;
  $met = "method".$i;
 
  $in = "instrument".$i;
  $re = "result".$i;
  $parameter = mysqli_real_escape_string($db, $_POST[$par]);
  $method = mysqli_real_escape_string($db, $_POST[$met]);
  $instrument = mysqli_real_escape_string($db, $_POST[$in]);
  $result = $_POST[$re];

  $insert = mysqli_query($db, "insert into lab_results (lab,sample,parameter,method,instrument,result,cycle) values ('$lab','$sample','$parameter','$method','$instrument','$result','$cycle')") ;
}
  if ($insert)
  {
   $output =  "success"; 
  }else
  {
  $output =  "Error, try again";
  }
  
}
else
{
  $output = "Please select a sample";
}

echo $output;
}



if ($action == "fetch_single")
{
    $id = $_POST['sub'];
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
    <th>Select</th>
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
                    <td><button id='$name' name='$id' class='btn btn-info active'>Select</button></td>
                    </tr>";
    $i++;}

   $response .= "</table><br>"; 
}
else
{
    $response = "<h3>Empty</h3>";
}
echo $response;

}

if ($action == "show")
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
      else
      {
          $user = $_SESSION['standard'];
      }
   
  $labs = mysqli_query($db, "select * from team where email='$user'");
  $row = mysqli_fetch_array($labs);
  
  $lab = $row['lab'];
  
    $name = $_POST['select'];
	$cycle = $_POST['cycle'];
   $output = "";
   $output .=  "
   <div class='text-center'>
   <h2>You have selected $name of $cycle</h2>
   </div>
   ";
	
    $output .= '
    
    <div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="table-responsive">
                ';    
    $output .="            
    <input type='hidden' id='cycle' name='cycle' value='$cycle'>
    <input type='hidden' id='sample' name='sample' value='$name'>
          ";
          $output .='
				<table class="table">
						    <thead>
						    <tr>
						        <th>Parameter</th>
						        <th>Method</th>
						   		<th>Instrument</th>
						   		<th>Result</th>     
						    </tr>
						    </thead>
							<tbody>
				';

								$get = mysqli_query($db, "select * from data where lab='$lab'");
                                $i = 1;
                                $count = mysqli_num_rows($get);
                                if ($count != 0)
                                {

                                while($rows = mysqli_fetch_array($get)){
                                $parameter = $rows['parameter'];
                                $fetch = mysqli_query($db, "select * from parameter where id='$parameter'");
                                $row = mysqli_fetch_array($fetch);
                                $parameter = $row['name'];
                                $method = $rows['method'];
                                $fetch = mysqli_query($db, "select * from method where code='$method'");
                                $row = mysqli_fetch_array($fetch);
                                $method = $row['name'];
                                
                                $instrument = $rows['instrument'];
                                $output .= "       
                                <tr>
              					<td>
								 <label class='control-label'>$parameter</label>
              					 <input type='hidden' name='parameter$i' id='parameter$i' value='$parameter'>
             					 </td>	
								 <td>
                                 <input name='method$i' id='method$i' value='$method' type='hidden'>
                                 <label class='control-label'>$method</label>
                                 </td> 
                                <td>
                                <input class='form-control' name='instrument$i' id='instrument$i' value='$instrument' type='hidden' />
                                <label class='control-label'>$instrument</label>
                                </td>
                                ";

                                
                           $output .= "        
								 <td>
								    <input type='number' min='1' class='form-control' name='result$i' id='result$i' placeholder='Result' required/>
             
								 </td>
                                 </tr>
                                 ";
                                $i++;}
                                 $output .= "
								</tbody>
                                
					</table>
				</div>
			</div>
		</div>
    </div>
    
    <textarea class='form-control' name='status' id='status' placeholder='Status of sample'></textarea>
    <input type='hidden' id='action' name='action' value='insert'>
	<button type='submit' id='submit' name='submit' class='btn btn-primary'>Upload</button>
</div>
";
                                }else{
                                $output =  "
                               <div class='text-center'>
                               <h2>Instruments not saved yet</h2>
                               </div>
                               ";
                                }
                                                           echo $output;
 } 



?>