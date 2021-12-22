<?php
include '../config.php';
if ( !$user->is_loggedin() ) {
  $user->redirect();
}
include '../includes/head.php';
include '../includes/sidebar.php';
?>
<style>
  td > img {
	max-width: 200px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="display: inline-block;">
        Customers
        <small>All Customers</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">       
        <!-- right column -->
        <div class="col-md-12">         
          <!-- general form elements disabled -->
          <div class="box box-warning">
			  <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>User</th>
				  <th>Email</th>
				  <th>Contact</th>		
				  <th>Active Plan</th>		
				  <th>Registered On</th>
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php 
        $users_arr = $user->get_users();
				if(isset($users_arr) && $users_arr!=''){
					foreach($users_arr as $value)
					{
						$user_id = $value->id;
						$UserNme = $value->name;
						$usrEmail = $value->email;
						$UsrCont = $value->contact;
						$AddedOn = $value->datetime;
						?>
						<tr id="userrow_<?php echo $user_id;?>">
										
							<td><?php echo $UserNme; ?></td>	
							<td><?php echo $usrEmail; ?></td>
							<td><?php echo $UsrCont; ?></td>
							<td id="userplan_<?php echo $user_id;?>">
							<?php 
							if($value->current_plan!=""){ 
								echo $value->current_plan;
							}
							else{
								$Plans = '<select name="ActivatePlan" class="form-control" onchange="return UpdatePlan(this.value)">
								<option value="">Select Plan to activate</option>';
								$plansdata = $user->GetPlans();
								foreach($plansdata as $val){
									$Plans .= "<option value='$user_id-$val'>$val</option>";
								}
								$Plans .= '</select>';
								echo $Plans;
							}
							?>
							</td>
							<td><?php echo $AddedOn; ?></td>
							<td>
							<a href="" class="btn btn-danger" onclick="RemoveCustomer(<?php echo $user_id; ?>)">Delete</a>
							</td>
						</tr>
					<?php } } ?>
                </tbody>
                
              </table>
            </div>
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
      <b><a href="<?php echo site_url; ?>"><?php echo SITENAME;?></a></b>
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
<script src="<?php echo $user->base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo $user->base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $user->base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>    
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
function RemoveCustomer(User_Id){
	var BASE_URL = '<?php echo $user->base_url(); ?>/postlog.php'; 
	$.ajax({
		type: 'post',
		url: BASE_URL + "/postlog",
		data: {"delete_customer":"YES","DelUserId":User_Id},
		success: function (result) {
			alert(result);
			$("#userrow_"+User_Id).hide();
		}
	});
	return false;
}

function UpdatePlan(plan){
	var BASE_URL = '<?php echo $user->base_url(); ?>/postlog.php'; 
	$.ajax({
		type: 'post',
		url: BASE_URL + "/postlog",
		data: {"updateSubscriptionPlan":"YES","ActivatePlan":plan},
		success: function (result) {
			var arr = plan.split('-');
			$("#userplan_"+arr[0]).html(arr[1]);
			alert(arr[1]+' plan activated successfully.');
		}
	});
	return false;
}
</script> 
</body>
</html>
