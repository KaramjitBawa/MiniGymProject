<?php
include '../config.php';
if ( !$user->is_loggedin() ) {
  $user->redirect();
}
include '../includes/head.php';
include '../includes/sidebar.php';
	$DietPlan = "";
	$BlogFooter = "UPDATE";
	$BoxTitle = "Update Diet Plan";
	$update = isset($_POST['DietPlan'])?"yes":"no";
	if($update=="yes")
	{	
		$DietPlan = $_POST['DietPlan'];
	}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Diet Plan
        <small><?php echo $BoxTitle;?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $BoxTitle;?>
		</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">  
		
        <!-- right column -->
        <div class="col-md-12">         
          <!-- general form elements disabled -->
          <div class="box box-warning">			
				<div class="box-header with-border">
					<h3 class="box-title"><?php echo $BoxTitle;?></h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">				
				  <form role="form" method="post" id="DietPlanFrm" onsubmit="return SaveDietPlan()">
					  <div class="form-group">
						  <label>Diet Plan </label>
						  <textarea class="DietPlanArea" id="DietPlanArea" name="DietPlan" placeholder="Job Description ..." style="width:100%" rows="10" cols="80"  required>
						  <?php echo ($_SESSION['LoginInfo']['diet_plan'])?$_SESSION['LoginInfo']['diet_plan']:$DietPlan;?></textarea>
					  </div>
					<div class="box-footer">
						<input type="submit" name="updateDietPlan" class="btn btn-primary" value="<?php echo $BoxTitle;?>">
					</div>
				  </form>				 
				</div>
				<!-- /.box-body -->
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b><a href="<?php echo SITEURL;?>"><?php echo SITENAME;?></a></b>
    </div>
    <strong>Copyright &copy; 2021.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3.1.1 -->
<script src="<?php echo $user->base_url(); ?>assets/plugins/jQuery/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $user->base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $user->base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!------- CK Editor -------------->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> 
<script type="text/javascript">
		$(document).ready(function(){
			CKEDITOR.replace('DietPlanArea');
		});
	</script>
<script>
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
  </script>
  <script>
function SaveDietPlan(){
var BASE_URL = '<?php echo $user->base_url(); ?>';
	var Content = CKEDITOR.instances['DietPlanArea'].getData();
	$.ajax({
		type: 'post',
		url: BASE_URL + "/postlog.php",
		data: {'update_diet':'YES','DietPlan':Content},
		cache: false,
		success: function (result) {
			alert(result);
			window.location.href = BASE_URL+"/dashboard.php";
		}
	});
	return false;
}
</script>
</body>
</html>