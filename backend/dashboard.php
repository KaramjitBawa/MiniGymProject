<?php
include 'config.php';
if ( !$user->is_loggedin() ) {
  $user->redirect();
}
//print_r($_SESSION);die;

include 'includes/head.php';
include 'includes/sidebar.php';

?>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}
table th {
    background-color: darkblue;
    color: #ffffff;
}
table td, table th {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 1.em;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
	Dashboard
	<small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
 
  <!-- Main row -->
  <div class="row">
	<?php if( $logintype=="ADMIN"){ ?>
	<!-- Left col -->
	<section class="col-lg-12 col-md-12 col-xs-12 connectedSortable">
	  <!-- quick email widget -->
	  <div class="box box-info">
		<div class="box-header">
		  <i class="fa fa-envelope"></i>
		  <h3 class="box-title">Welcome !!!</h3>
		</div>
		
			<div class="box-body">		
				<h2>Welcome to Dashboard...</h2>
				<img width=800 src="<?php echo SITEURL."images/training-828715.jpg";?>">
			</div>
	  </div>
	</section>
	<!-- /.Left col -->
	<?php }  ?>
	<?php if( $logintype=="CUSTOMER"){ ?>
	<!-- Left col -->
	<section class="col-lg-7 connectedSortable">
	  <!-- quick email widget -->
	  <div class="box box-info">
		<div class="box-header">
		  <i class="fa fa-envelope"></i>
		  <h3 class="box-title">Your Current Diet Plan:</h3>
		</div>
		
			<div class="box-body">		
				<?php echo $_SESSION['LoginInfo']['diet_plan'];?>
			</div>
	  </div>
	</section>
	<!-- /.Left col -->
	<?php }  ?>
  </div>
  <!-- /.row (main row) -->
</section>
<!-- /.content -->
</div>
<?php include 'includes/footer.php';?>
<!-- /.content-wrapper -->