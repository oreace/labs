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
$cycle = $_POST['cycle'];
$count = $_POST['count'];
$output = "";
$insert = "";
$check = mysqli_query($db, "select * from limits where cycle='$cycle' and sample='$sample'");
$c = mysqli_num_rows($check);
if ($c == 0)
{
for ($i = 1; $i<=$count; $i++)
{
  $par = "parameter".$i;
  $mine = "min".$i;
  $maxe = "max".$i;
  $parameter = $_POST[$par];
  $min = $_POST[$mine];
  $max = $_POST[$maxe];
  //  $output .= $parameter."<br>".$min."<br>".$max."<br>".$cycle."<br>".$sample."<br>";
  $insert = mysqli_query($db, "insert into limits (parameter,min,max,sample,cycle) values ('$parameter','$min','$max','$sample','$cycle')");
}
  if ($insert)
  {
   $output =  "success"; 
  }
  else
  {
  $output =  "Error, try again";
  }
}
else
{
   $output = "Limit already set"; 
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
                    <td><button id='$name' name='$id' class='btn btn-info activer'>Select</button></td>
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
						        <th>min</th>
						   		<th>max</th>
						    </tr>
						    </thead>
							<tbody>
				';

								$get = mysqli_query($db, "select * from parameter");
                                $i = 1;
                                $count = mysqli_num_rows($get);
                                if ($count != 0){

                                for ($j=1; $j<=20; $j++)
                                {    
                                
                                
                                $output .= "       
                                <tr>
              					<td>
                                 <select name='parameter$i' id='parameter$i' class='form-control'>
                                .";
        						$gets = mysqli_query($db, "select * from parameter");
                                while($rows = mysqli_fetch_array($gets)){
                                    $id = $rows['id'];
                                    $name = $rows['name'];
        
                                $output .= "<option value='$id'>$name</option>";
                                }
                                $output .="
                                 </select>
                                 </td>	
							    <td>
                                 <input type='number' min='0' class='form-control' name='min$i' id='min$i' step='0.01' placeholder='Min Value' required/>
                              </td>
                             ";

                                
                           $output .= "        
								 <td>
								<input type='number' min='0' class='form-control' name='max$i' id='max$i' step='0.01' placeholder='Max Value' required/>
                                    
								 </td>
                                 </tr>
                                 <input type='hidden' id='count' name='count' value='$i'>
                                 
                                 ";
                                $i++;}
                                 $output .= "
								</tbody>
                                
				
						</table>
				</div>
			</div>
		</div>
	</div>
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