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
        Locations
        <small>All locations</small>
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
                  <th>Location Name</th>
				  <th>Address</th>
				  <th>Co-ordinates(Long.,Lat.)</th>
				  <th>Postal Code</th>
				  <th>Email</th>
				  <th>Contact</th>		
				  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php 
        $users_arr = $user->getData('tbl_Locations',array("status"=>1));
				if(isset($users_arr) && $users_arr!=''){
					foreach($users_arr as $value)
					{
						$location_id = $value->id;
						$LocNme = $value->location_name;
						$LocEmail = $value->email;
						$LocCont = $value->contact;
						$LocAddr = $value->address;
						?>
						<tr id="locrow_<?php echo $location_id;?>">
							<td><?php echo $LocNme; ?></td>	
							<td><?php echo $LocAddr; ?></td>
							<td><?php echo $value->longitude.",".$value->latitude; ?></td>
							<td><?php echo $value->postal_code; ?></td>
							<td><?php echo $LocEmail; ?></td>
							<td><?php echo $LocCont; ?></td>
							<td >
						  <form method='post' action='add-location.php'>
							<input type='hidden' name='UpLocId' value='<?php echo $location_id; ?>' />
							<input type='hidden' name='LocName' value='<?php echo $LocNme; ?>' />
							<input type='hidden' name='LocAddress' value='<?php echo $LocAddr; ?>' />
							<input type='hidden' name='LocPostalCode' value='<?php echo $value->postal_code; ?>' />
							<input type='hidden' name='LocState' value='<?php echo $value->state_id; ?>' />
							<input type='hidden' name='LocCity' value='<?php echo $value->city_id; ?>' />
							<input type='hidden' name='LocContact' value='<?php echo $LocCont; ?>' />
							<input type='hidden' name='LocEmail' value='<?php echo $LocEmail; ?>' />
						<input type='hidden' name='LocLong' value='<?php echo $value->longitude; ?>' />
						<input type='hidden' name='LocLat' value='<?php echo $value->latitude; ?>' />
							<input type='submit' name='update' value='Update' class='btn btn-primary' />&nbsp;&nbsp;
							</form>
							<br>
							  <a href="" class="btn btn-danger" onclick="deleteLocation(<?php echo $location_id; ?>)">Delete</a>
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
      <b><a href="<?php echo SITEURL; ?>"><?php echo SITENAME;?></a></b>
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
function deleteLocation(location_Id){
	var BASE_URL = '<?php echo $user->base_url(); ?>/postlog.php'; 
	$.ajax({
		type: 'post',
		url: BASE_URL + "/postlog",
		data: {"delete_location":"YES","DelLocId":location_Id},
		success: function (result) {
			alert(result);
			$("#locrow_"+location_Id).hide();
		}
	});
	return false;
}
</script> 
</body>
</html>
