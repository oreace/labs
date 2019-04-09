<?php 
if (isset($_SESSION))
{
	session_destroy();
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Login</title>
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


<div>
	<div class="container">
		<div class="row">
				<div class="text-center">
					<h1>Klinchex Test Result Verifier Services - Login Area</h1>
				</div>

		</div>
	</div>

	
	<div class="container">
		<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" id="login_form" method="post">
			<h2>Sign in</h2>
			<hr class="colorgraph">

			<div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Enter Email" tabindex="1">
			</div>
			<div class="form-group">
				<input type="password" class="form-control input-lg" id="password" name="password" placeholder="Enter Password" tabindex="2">
			</div>
		
			<hr class="colorgraph">
			<div class="row">
				<input type="hidden" name="action" id="action" value="login">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Sign in" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
			<p>	To register your Lab, please click <a href="register">Here</a></p>
			</div>
		</form>
      </div>

	</div>

</div>




</div>

<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="app/set.js"></script>

</body>
</html>
