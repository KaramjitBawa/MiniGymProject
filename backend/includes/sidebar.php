<?php
if ( !$user->is_loggedin() ) {
  $user->redirect();
}
if(!isset($SESSION['LoginInfo'])){
	$ad_info = $user->getAdmin($_SESSION['loginID']);
}else{
	$ad_info = $SESSION['LoginInfo'];
}
$logintype = strtoupper($ad_info['user_type']) ;
$loginid = $_SESSION['loginID'];
?>
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">
	  <img src="<?php echo $user->base_url(). "assets/dist/img/admin.png"?>" class="img-circle" alt="User Image">
	</div>
	<div class="pull-left info">
	  <p><?php echo $loginid; ?></p>
	  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
	</div>
  </div>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
	<li>
	  <a href="<?php echo site_url."/dashboard.php"; ?>">
		<i class="fa fa-dashboard"></i> <span>Dashboard </span>
	  </a>
	</li>	
	<?php if( $logintype=="ADMIN"){ ?>
	<li class="treeview">
	  <a href="#">
		<i class="fa fa-file-o"></i> <span>Locations</span>
		<span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span>
	  </a>
	  <ul class="treeview-menu">
		<li class="active"><a href="<?php echo site_url."/pages/add-location.php"; ?>"><i class="fa fa-circle-o"></i> Add Location</a></li>
		<li class="active"><a href="<?php echo site_url."/pages/view_locations.php"; ?>"><i class="fa fa-circle-o"></i> View Locations</a></li>
	  </ul>
	</li>
	<li>
	  <a href="<?php echo site_url."/pages/view_customers.php"; ?>">
		<i class="fa fa-user"></i> <span>Customers</span>
	  </a>
	</li>
	<?php } ?>
	<?php if( $logintype=="CUSTOMER"){ ?>
	<li>
	  <a href="<?php echo site_url."/pages/add-diet-plan.php"; ?>">
		<i class="fa fa-user"></i> <span>Diet Plan</span>
	  </a>
	</li>
	<?php } ?>	
  </ul>
</section>
<!-- /.sidebar -->
</aside>