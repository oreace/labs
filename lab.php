<?php 
include("app/session.php");
include("app/functions.php");

if (!isset($_SESSION['lead'])){echo "<script>window.open('home','_self')</script>";}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Lab</title>
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

<header>
	<!-- menu bar -->
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
	<div class="container">
		<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" id="lab_form" method="post">
			<hr class="colorgraph">
			<?php 
				$user = $_SESSION['lead'];
			$get = mysqli_query($db, "select * from team where email='$user'");
			$row = mysqli_fetch_array($get);
			$lab = $row['lab'];

			$in = mysqli_query($db, "select * from lab where name='$lab'");
			$re = mysqli_fetch_array($in);
			$address = $re['address'];
			?>
			<div>
			<h3>Your registered email is <?php echo $user; ?> </h3>
			<h3>You're registered to <?php echo $lab; ?></h3>
			</div>
	        
            <div class="form-group">
				<textarea rows="5" name="address" id="address" class="form-control input-lg" placeholder="Enter Address" tabindex="6"><?php echo $address; ?></textarea> 
			</div>
        	
    		<hr class="colorgraph">
			<div class="row">
				<input type="hidden" name="lab" id="lab" value="<?php echo $lab; ?>">
				<input type="hidden" name="action" id="action" value="update_lab">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Update" class="btn btn-primary btn-block btn-lg" tabindex="9"></div>
			</div>
		</form>
      </div>

	</div>

</div>



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
