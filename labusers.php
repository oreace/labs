<?php 
include("app/session.php");
if (!isset($_SESSION['lead'])){echo "<script>window.open('home','_self')</script>";}?>
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Lab Users</title>
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
	<div class="modal fade" id="usersModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title" id="myModalLabel"> Add New</h4>
				</div>
				<div class="modal-body">
			<form enctype="multipart/form-data" id="users_form">
			<div class="info-box">
    	    <p></p>
 	   		</div>
				
				<div class="form-group">
					<input id="name" name="name" class="form-control" placeholder="Enter Name" tabindex="1" required>
				</div>

				<div class="form-group">
					<input type="email" id="email" name="email" class="form-control" placeholder="Enter Email" tabindex="2" required>
				</div>

				<div class="form-group">
					<input id="gsm" name="gsm" class="form-control" placeholder="Enter Phone Number" tabindex="3" required>
				</div>

				<div class="form-group">
					<textarea class="form-control" rows="5" name="address" id="address" tabindex="4" required></textarea>
				</div>

				<div class="form-group">
					<input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" tabindex="5" required>
				</div>


				</div>
				<div class="modal-footer">
					<input type="hidden" id="pass" name="pass">
					<input type="hidden" id="id" name="id">
					<input type="hidden" id="action" name="action">
					<input type="submit" name="operation" id="operation" class="btn btn-primary" value="Insert">
				</div>
			</form>
		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- menu bar -->

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
   <section class="callaction">
	<div class="container">
		<div class="row">
					<div class="cta-btn">
						<a type="button" href="#" id="add_users" data-toggle="modal" data-target="#usersModal" class="btn btn-primary btn-lg">Add new <i class="fa fa-user"></i></a>
					</div>
		</div>
	</div>
	</section>

<div>
	<section id="content">
		<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="text-center">
					<h2>Lab Users</h2>					
				</div>
			</div>		
		</div>
		</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="row">
					<div class="table-responsive">
	

				<table id="users_table" data-toggle="table" data-url="app/users.php?action=fetch"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th>ID</th>
						        <th data-sortable="true">Name</th>
						   		<th data-sortable="true">Email</th>
								<th data-sortable="true">Gsm</th>   
						   		<th data-sortable="true">Address</th>     
								<th>Edit</th>
								<th>Delete</th>
						    </tr>
						    </thead>
						</table>
						
				</div>
			</div>
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
