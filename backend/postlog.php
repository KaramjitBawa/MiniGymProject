<?php
include 'config.php';
/**print_r($_REQUEST);die;**/
	if(isset($_POST['submit']))
	{
		$loginid=$_POST['loginid'];
		$password=$_POST['password'];
		$table='admin';
		$login = $user->login($loginid,$password);
		if (is_array($login))                   
		{  
			$_SESSION['loginID']=$login['email'];
			$_SESSION['LoginInfo'] = $login;
			echo "<script>window.open('dashboard.php','_self')</script>";
		}
		else {
			echo "<script>alert('Email or Password is Wrong')</script>";
			echo "<script>window.open('login.php','_self')</script>";
		}
	}
	
/*************************add/update/delete locations*****************/
	if(isset($_REQUEST['add_location']))
	{
		$LocName = $_POST['LocName'];
		$LocPostalCode = $_POST['LocPostalCode'];
		$LocContact = $_POST['LocContact'];
		$LocEmail = $_POST['LocEmail'];
		$LocState = $_POST['LocState'];
		$LocCity = $_POST['LocCity'];
		$LocAddress = $_POST['LocAddress'];
		$LocLong = $_POST['LocLong'];
		$LocLat = $_POST['LocLat'];
		$custom_data = array('location_name'=>$LocName,'address' => $LocAddress,'postal_code'=>$LocPostalCode,'state_id'=>$LocState,'city_id'=>$LocCity,'contact'=>$LocContact,'email'=>$LocEmail,'longitude'=>$LocLong,'latitude'=>$LocLat);
		$last_id = $user->InsertData_without_date( 'tbl_locations', $custom_data );
		if ( $last_id ) {
			echo 'Your details added successfully.';
		}
		else{
		   echo 'Error.Please try after some time.';
		}
	}
	/****** Update Locations *******/
	if(isset($_POST['UpdateLocation']))
	{
		$update_id = isset($_POST['UpLocId'])?$_POST['UpLocId']:"";
		$LocName = $_POST['LocName'];
		$LocPostalCode = $_POST['LocPostalCode'];
		$LocContact = $_POST['LocContact'];
		$LocEmail = $_POST['LocEmail'];
		$LocState = $_POST['LocState'];
		$LocCity = $_POST['LocCity'];
		$LocAddress = $_POST['LocAddress'];
		$LocLong = $_POST['LocLong'];
		$LocLat = $_POST['LocLat'];
		$custom_data = array('location_name'=>$LocName,'address' => $LocAddress,'postal_code'=>$LocPostalCode,'state_id'=>$LocState,'city_id'=>$LocCity,'contact'=>$LocContact,'email'=>$LocEmail,'longitude'=>$LocLong,'latitude'=>$LocLat);
		$update_id=$user->updateFields('tbl_locations',$custom_data, $update_id,'id');
		if ( $update_id ) {
			echo "Details of location `$LocName` updated successfully.";
		}
		else{
			echo 'Error.Please try after some time';
		}
    }
                 
	if(isset($_POST['delete_location']))
	{
		$del_id = isset($_POST['DelLocId'])?$_POST['DelLocId']:"";
		$delete_id=$user->deleteFields('tbl_locations', $del_id,'id');
		if ( $delete_id ) {
            echo $res = 'Location deleted successfully';
		}
		else{
			echo $res = 'Please try after some time';
		}
	}
	
	/********** Delete Customer ********/
	if(isset($_POST['delete_customer']))
	{
		$del_id = isset($_POST['DelUserId'])?$_POST['DelUserId']:"";
		$delete_id=$user->deleteFields('tbl_users', $del_id,'id');
		if ( $delete_id ) {
            echo $res = 'Customer record deleted successfully';
		}
		else{
			echo $res = 'Please try after some time';
		}
	}
	/******* Update Diet Plan **********/
	if(isset($_REQUEST['update_diet']))
	{
		$DietPlan = $_POST['DietPlan'];
		$UserId = $_SESSION['LoginInfo']['id'];
		$_SESSION['LoginInfo']['diet_plan'] = $DietPlan;
		$custom_data = array('diet_plan'=>$DietPlan);
		$last_id = $user->updateFields('tbl_users',$custom_data, $UserId, 'id' );
		if ( $last_id ) {
			echo 'Your Diet Plan updated successfully.';
		}
		else{
		   echo 'Error.Please try after some time.';
		}
	}
	/******* Update Diet Plan **********/
	if(isset($_REQUEST['updateSubscriptionPlan']))
	{
		$ActivatePlanVals = explode("-",$_POST['ActivatePlan']);
		$custom_data = array('current_plan'=>$ActivatePlanVals[1]);
		$UserId = $ActivatePlanVals[0];
		$last_id = $user->updateFields('tbl_users',$custom_data, $UserId, 'id' );
		if ( $last_id ) {
			echo 'Plan activated successfully.';
		}
		else{
		   echo 'Error.Please try after some time.';
		}
	}
?>