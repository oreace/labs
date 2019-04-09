<?php 
include("app/session.php");
include("app/functions.php");

?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Test Event</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link href="css/bootstrap-table.css" rel="stylesheet" />
<link href="css/font-awesome.css" rel="stylesheet" />

</head>
<body>

<div id="wrapper">
<div class="modal fade" id="msgModal">
	<div class="alert text-center col-lg-offset-5 col-lg-2 col-md-offset-4 col-md-3" id="color">
		<span id="msg" class="text-center"></span>
	</div>
</div>

<div id="sampModal" class="modal fade">
	 <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Samples</h4>
               </div>
            <div class="modal-body">
                <span id="result"></span>
           </div>     
         <div class="modal-footer">
	  		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	  	 </div>

        </div>
</div>
</div>

<header>
	<div class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="dashboard"><h2 style="color:blue;">KTRVS</h2></a>
			</div>
			<div class="navbar-collapse collapse">
			<?php 
			bar();
			?>
			</div>
		</div>
	</div><!-- /menu bar -->

</header>
<div>
	<section id="content">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
				           <h2>Select a Subscription</h2>
						   <form id="sub_select">
						   <div class="col-lg-5">
						   <p>
						   <select name="sub" id="sub" class="form-control">
						   <?php 
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
								$query = "select * from subs where lab='$lab'";
								$result = mysqli_query($db, $query);
								while($rows = mysqli_fetch_array($result))
								{

								
								$sub = $rows['sub'];

								$get = mysqli_query($db, "select * from cycle where id='$sub'");
								$row = mysqli_fetch_array($get);
								   	$enddate = $row['enddate'];
    								$date = date("Y-m-d");
 	   								if ($enddate > $date )
    								{
										
									
						   	 
						   			?>
						   <option value='<?php echo $row['name']; ?>'><?php echo $row['name']; ?></option>
						   <?php }} ?>
						   </select>
						   </p>
						   </div>
						   
						   <div class="col-lg-2">
						   <p>
						   <input type="hidden" name="action" id="action" value="fetch_single">
						   <input type="submit" class="btn btn-primary" value="Select">
						   
						   </p>
						   </div>
						   </form>
         		</div>
			</div>		
		</div>
		</div>
		<img src="loading.gif" class="hidden" style="display:block; margin:auto; " />
		<form id="test_form">
	<span id="show"></span>
	</form>


<footer>
	<div id="sub-footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="copyright">
					<p>&copy; <a href="http://litbulb.org">litbulb</a> - All Right Reserved</p>
                     	</div>
				</div>
				<div class="col-lg-6">
					<ul class="social-network">
						<li><a href="https://facebook.com/" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
						<li><a href="https://twitter.com/" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>

</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="app/set.js"></script>

</body>
</html>