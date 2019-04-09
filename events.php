<?php 
include("app/session.php");
?>
<html lang="en">
<head>
<meta charset="utf-8">
<title>KTRVS - Create Events</title>
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
		<form role="form" id="events_form" method="post">
			<hr class="colorgraph">
			<div>
			</div>
	        <div class="control-group">
              <label class="control-label">Cycle Name</label>
              <div class="controls">
          	  <input type="form-control" name="name" id="name">
             </div>
            </div>
            <div class="form-group">
              <label>Start Date</label>
              <div class="controls">
                <input type="date" name="startdate" id="startdate" class="form-control">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">End Date</label>
              <div class="controls">
                <input type="date" name="enddate" id="enddate" class="form-control">
              </div>
            </div>
            


            <div class="control-group">
              <label class="control-label">Sample I</label>
              <div class="controls">
                <input type="hidden" name="sample1" id="sample1" value="Sample I">
                <input type="text" class="form-control" name="result1" id="result" placeholder="Expected Sample Result" required/>
              </div>
            </div>

           


            <div class="control-group">
              <label class="control-label">Sample Description</label>
              <div class="controls">
                <textarea class="form-control" name="desc1" id="desc1" required></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Sample II</label>
              <div class="controls">
                <input type="hidden" name="sample2" id="sample2" value="Sample II">
                <input type="text" class="form-control" name="result2" id="result2" placeholder="Expected Sample Result" required/>
              </div>
            </div>

            
            <div class="control-group">
              <label class="control-label">Sample Description</label>
              <div class="controls">
                <textarea class="form-control" name="desc2" id="desc2" required></textarea>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">Sample III</label>
              <div class="controls">
                <input type="hidden" name="sample3" id="sample3" value="Sample III">
                <input type="text" class="form-control" name="result3" id="result3" placeholder="Expected Sample Result" required/>
              </div>
            </div>
      
            <div class="control-group">
              <label class="control-label">Sample Description</label>
              <div class="controls">
                <textarea class="form-control" name="desc3" id="desc3" required></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Sample IV</label>
              <div class="controls">
                <input type="hidden" name="sample4" id="sample4" value="Sample IV">
                <input type="text" class="form-control" name="result4" id="result4" placeholder="Expected Sample Result" required/>
              </div>
            </div>
             
          
            <div class="control-group">
              <label class="control-label">Sample Description</label>
              <div class="controls">
                <textarea class="form-control" name="desc4" id="desc4" required></textarea>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Sample V</label>
              <div class="controls">
                <input type="hidden" name="sample5" id="sample5" value="Sample V">
                <input type="text" class="form-control" name="result5" id="result5" placeholder="Expected Sample Result" required/>
              </div>
            </div>
             
          

            <div class="control-group">
              <label class="control-label">Sample Description</label>
              <div class="controls">
                <textarea class="form-control" name="desc5" id="desc5" required></textarea>
              </div>
            </div>


    
    		<hr class="colorgraph">
			<div class="row">
				<input type="hidden" name="action" id="action" value="insert">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Insert" class="btn btn-primary btn-block btn-lg"></div>
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
<script src="js/jquery-ui.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>
<script src="app/set.js"></script>

<script>
$(document).ready(function () {

    $("#startdate").datepicker({
        dateFormat: "dd-mm-yyyy",
        minDate: 0,
        onSelect: function (date) {
            var date2 = $('#startdate').datepicker('getDate');
            date2.setDate(date2.getDate() + 1);
            $('#enddate').datepicker('setDate', date2);
            //sets minDate to startdate date + 1
            $('#enddate').datepicker('option', 'minDate', date2);
        }
    });
    $('#enddate').datepicker({
        dateFormat: "dd-mm-yyyy",
        onClose: function () {
            var startdate = $('#startdate').datepicker('getDate');
            var enddate = $('#enddate').datepicker('getDate');
            //check to prevent a user from entering a date below date of startdate
            if (enddate <= startdate) {
                var minDate = $('#enddate').datepicker('option', 'minDate');
                $('#enddate').datepicker('setDate', minDate);
            }
        }
    });
});
</script>
-->
</body>
</html>
