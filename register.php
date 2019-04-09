<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Register</title>
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
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" id="register_form" method="post">
			<h2>Team Lead - Register Page</h2>
			<hr class="colorgraph">
            </h2>Laboratory Details</h2>
            
			<div class="form-group">
				<input name="name_lab" id="name_lab" class="form-control input-lg" placeholder="Enter Name of Lab" tabindex="1">
			</div>
		
            <div class="form-group">
				<textarea rows="5" name="address_lab" id="address_lab" class="form-control input-lg" placeholder="Enter Address of Lab" tabindex="2"></textarea> 
			</div>
            
            <hr class="colorgraph">
            </h2>Team Lead Details</h2>

            <div class="form-group">
				<input name="name" id="name" class="form-control input-lg" placeholder="Enter Name" tabindex="3">
			</div>
		
            <div class="form-group">
				<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Enter Email" tabindex="4">
			</div>

             <div class="form-group">
				<input type="number" min="1" name="gsm" id="gsm" class="form-control input-lg" placeholder="Enter Phone Number" tabindex="5">
			</div>


            <div class="form-group">
				<textarea rows="5" name="address" id="address" class="form-control input-lg" placeholder="Enter Address" tabindex="6"></textarea> 
			</div>
            



        	<div class="form-group">
				<input type="password" class="form-control input-lg" id="password" name="password" placeholder="Enter Password" tabindex="7">
			</div>
		
        	<div class="form-group">
				<input type="password" class="form-control input-lg" id="cpassword" name="cpassword" placeholder="Retype Password" tabindex="8">
			</div>
	
    		<hr class="colorgraph">
			<div class="row">
				<input type="hidden" name="action" id="action" value="register">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="9"></div>
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
