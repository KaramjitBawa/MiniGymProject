<?php
include '../config.php';
if ( !$user->is_loggedin() ) {
  $user->redirect();
}
include '../includes/head.php';
include '../includes/sidebar.php';
	$LocName = $LocAddress = $LocPostalCode = $selectedstate = $selectedcity = "";
	$LocContact = $LocEmail = $LocLong = $LocLat = "";
	$BlogFooter = "ADD";
	$BoxTitle = "Add Location";
	$update = isset($_POST['UpLocId'])?"yes":"no";
	//print_r($_POST);
if($update=="yes")
	{
		$LocName = $_POST['LocName'];
		$BlogFooter = "UPDATE";
		$BoxTitle = "Update Location";
		$EventId = $_POST['UpLocId'];
		$LocAddress = $_POST['LocAddress'];
		$LocLong = $_POST['LocLong'];
		$LocLat = $_POST['LocLat'];
		$LocPostalCode = $_POST['LocPostalCode'];
		$selectedstate = $_POST['LocState'];
		$selectedcity = $_POST['LocCity'];
		$LocContact =$_POST['LocContact'];
		$LocEmail =$_POST['LocEmail'];
	}	
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add location
        <small><?php echo $BoxTitle;?></small>
      </h1>
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
				  <form role="form" method="post"  id="LocationFrm" onsubmit="return SaveLocationData()">
					  <div class="form-group col-md-6">
						  <label>Location Name </label>
						  <input class="form-control" type="text" name="LocName" placeholder="e.g East York Town Centre.." value="<?php echo $LocName; ?>" required/>
					  </div>
					  <div class="form-group col-md-6">
						  <label>Postal code </label>
						  <input class="form-control" type="text" name="LocPostalCode" placeholder="XXX XXX....." value="<?php echo $LocPostalCode; ?>" required/>
					  </div>
					  <div class="form-group col-md-12">
						  <label>Address </label>
						  <input class="form-control" type="textarea" name="LocAddress" placeholder="Street no,area etc....." rows=4 cols=4 value="<?php echo $LocAddress; ?>" required/>
					  </div>
					  <div class="form-group col-md-12">
						  <label>Logitude </label>
						  <input class="form-control" type="text" name="LocLong" placeholder=" longitude....." value="<?php echo $LocLong; ?>" required/>
					  </div>
					  <div class="form-group col-md-12">
						  <label>Latitude </label>
						  <input class="form-control" type="text" name="LocLat" placeholder=" longitude....." value="<?php echo $LocLat; ?>" required/>
					  </div>
					   <div class="form-group col-md-6">
						  <label>Contact </label>
						  <input class="form-control" type="text" name="LocContact" placeholder="(416) XXX XXXX....." value="<?php echo $LocContact; ?>" required/>
					  </div>
					   <div class="form-group col-md-6">
						  <label>Email </label>
						  <input class="form-control" type="text" name="LocEmail" placeholder="xyz@gmail.cm etc....." value="<?php echo $LocEmail; ?>" required/>
					  </div>
					<div class="form-group col-md-6">
						<label>State</label>
						<select name="LocState" class="form-control"  style="width: 100%;" onchange="getAllCities(this.value)">
							<?php
							$getstatedata = $user->getData('tbl_states',array("country_id"=>2));
								foreach($getstatedata as $value)
								{
									$name= $value->name;
									$id=$value->id;
									if($selectedstate==null){
										$selectedstate = array("");
									}
									?>
									<option <?php if($selectedstate==$id){ echo 'selected="selected"'; } ?> value="<?php echo $id; ?>"><?php echo $name?> </option>	
								<?php } 
							?>
						</select>
					</div>	
					<div class="form-group col-md-6">
						<label>City</label>
						<select name="LocCity" class="form-control"  id="cities" style="width: 100%;">
							<?php
							$StateId = ($selectedstate==null)?1:$selectedstate;
							$getcitydata = $user->getData('tbl_cities',array("state_id"=>$StateId));
								foreach($getcitydata as $value)
								{
									$name= $value->city_name;
									$cityid=$value->id;
									if($selectedcity==null){
										$selectedcity = array("");
									}
									?>
									<option <?php if($selectedcity==$cityid){ echo 'selected="selected"'; } ?> value="<?php echo $cityid; ?>"><?php echo $name?> </option>	
								<?php } 
							?>
						</select>
					</div>	
					<?php if($BlogFooter == "ADD"){ ?>
					<div class="box-footer  col-md-12">
						<input type="hidden" name="add_location" value="YES" />
						<input type="submit" name="add_location" class="btn btn-primary" value="<?php echo $BoxTitle;?>">
					</div>
					<?php } ?>
					<?php if($BlogFooter == "UPDATE"){ ?>
					<div class="box-footer  col-md-12">
						<input type="hidden" name="UpLocId" value="<?php echo $EventId; ?>" />
						<input type="hidden" name="UpdateLocation" value="YES" />
						<input type="submit" name="UpdateLocation" class="btn btn-primary" value="<?php echo $BoxTitle;?>">
					</div>
					<?php } ?>
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
<!-- AdminLTE App -->
<script src="<?php echo $user->base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo $user->base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $user->base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
function SaveLocationData(){
var BASE_URL = '<?php echo $user->base_url(); ?>';  
	$.ajax({
		type: 'post',
		url: BASE_URL + "/postlog.php",
		data: $("#LocationFrm").serialize(),
		success: function (result) {
			alert(result);
			window.location.href = BASE_URL+"/pages/view_locations.php";
		}
	});
	return false;
}
</script>
<script>
function getAllCities(state_Id){
var BASE_URL = '<?php echo SITEURL; ?>'; 
	$.ajax({
		type: 'post',
		url: BASE_URL + "/function/requestUpdate.php?requestType=GetCities",
		data: {"stateId":state_Id},
		success: function (result) {
			$("#cities").html(result);
		}
	});
}
</script> 
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

</body>
</html>