<?php 
include("app/session.php");
include("app/functions.php");
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Instruments</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<link href="css/bootstrap-table.css" rel="stylesheet" />
<link href="css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />

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
    <div class="col-lg-12">
		<form role="form" id="instrument_form" method="post">
			<hr class="colorgraph">
			<div>
			</div>
            <table class="table">
						    <thead>
						    <tr>
						        <th>Instrument</th>
						        <th>Manufacturer</th>
                                <th>Parameter</th>
                                <th>Method</th>
                               </tr>
						    </thead>
							<tbody>
			
<?php
$user = "";
if (isset($_SESSION['lead']))
{
$user = $_SESSION['lead'];
}
$need = mysqli_query($db, "select * from team where email='$user'");
$it = mysqli_fetch_array($need);
$lab = $it['lab'];
    
$i = 1;
$get = mysqli_query($db, "select * from data where lab='$lab' LIMIT 20");

$row = mysqli_fetch_array($get);
for ($row=1; $row<=20; $row++){
?>
            <tr>
            <td>
            <div class="form-group">
            <?php echo $row['instrument']; ?>
            <select name="instrument<?php echo $i; ?>" id="instrument<?php echo $i ?>" class="selectpicker" data-show-subtext="true" data-live-search="true">
            <?php 
            $select = mysqli_query($db, "select * from instrument");
            while($one = mysqli_fetch_array($select)){ 
            ?> 
            <option value="<?php echo $one['name']; ?>"><?php echo $one['name']; ?></option>
            <?php } ?>
            </select>
        	</div>
                </td>
                <td>
            <div class="form-group">
            <?php echo $row['manufacturer']; ?>
            <select name="manufacturer<?php echo $i; ?>" id="manufacturer<?php echo $i; ?>" class="selectpicker" data-show-subtext="true" data-live-search="true">
            <?php 
            $select = mysqli_query($db, "select * from manufacturer");
            while($one = mysqli_fetch_array($select)){ 
            ?>
            <option value="<?php echo $one['name']; ?>"><?php echo $one['name']; ?></option>
            <?php } ?>
            </select>
        	</div>
                </td>
                <td>
            <div class="form-group">
            <?php echo $row['parameter']; ?>
            <select name="parameter<?php echo $i; ?>" id="<?php echo $i; ?>" class="selectpicker parameter" data-show-subtext="true" data-live-search="true">
            <option>--Select--</option>
            <?php 
            $select = mysqli_query($db, "select * from parameter");
            while($one = mysqli_fetch_array($select)){ 
            ?>
            <option value="<?php echo $one['id']; ?>"><?php echo $one['name']; ?></option>
            <?php } ?>
            </select>
        	</div>
            </td>
                <td>
            <div class="form-group">
            <?php echo $row['method']; ?>
            <select name="method<?php echo $i; ?>" id="method<?php echo $i; ?>" row="<?php echo $i; ?>" class="form-control method">
            <option></option>
            </select>
        	<input name="method<?php echo $i; ?>" id="methods<?php echo $i; ?>" class="form-control methods hidden">
			</div>
                </td>
       
				<input type="hidden" name="id<?php echo $i; ?>" id="id<?php echo $i; ?>" value="<?php echo $row['id']; ?>">
				<?php $i++;} ?>
           </tbody>
           </table>    
    		<hr class="colorgraph">
			<div class="row">
				<input type="hidden" name="action" id="action" value="insert">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

<script>
    $('.method').change(function(){
    var id = $(this).val();
    var row = $(this).attr("row");

    if (id == "APPO")
    {
        $('#methods'+row).removeClass('hidden');
        $('#method'+row).addClass('hidden');
    }
   

    });
</script>
</body>
</html>
