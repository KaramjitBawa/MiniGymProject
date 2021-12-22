<?php
$requestType = $_GET['requestType'];
include("dbFunction.php");
$Exec = new GlobalClass();
switch($requestType){
	case "RegisterForm":
		$name=$_POST['myNAME'];
		$Plan=$_POST['myPlan'];
		$email=$_POST['myEmail'];
		$contact=$_POST['myMob'];
		$password=$_POST['pass'];
		$data = array($name,$email,$contact,$password,$Plan);
	    $InsertData = $Exec->NewUserRegister($data);
		if($InsertData=="NA"){
			$resdata = array("status"=>2);
		}elseif($InsertData==true){
			$resdata = array("status"=>1,"code"=>$InsertData);
		}else{
			$resdata = array("status"=>0);
		}
		echo json_encode($resdata);die;
	break;
	case "GetStates":
		$StatesData = $Exec->getStatesList();
		if(!empty($StatesData)){
			$selecthtml = "<option>Select a province</option>";
			while($rowdata=mysqli_fetch_array($StatesData))	{						
				$state= $rowdata['name'];
				$stateId= $rowdata['id'];
				$selecthtml .= "<option value='$stateId'>$state</option>";				
			}
			echo $selecthtml;
		}else{
			echo "<option>Ontario</option>";
		}
	break;	
	case "GetCities":
		$StateId = $_POST['stateId'];
		$CitiesData = $Exec->getCitiesList($StateId);
		if(!empty($CitiesData)){
			$selecthtml = "<option value=0>Select a city</option>";
			while($rowdata=mysqli_fetch_array($CitiesData))	{						
				$city= $rowdata['city_name'];
				$cityId= $rowdata['id'];
				$selecthtml .= "<option value='$cityId'>$city</option>";				
			}
			echo $selecthtml;
		}else{
			echo "<option>NA</option>";
		}
	break;
	case "GetAllLocations":
		$StateId = $_POST['province'];
		$CityId = $_POST['city'];
		//print_r($_POST);
		$CitiesData = $Exec->getLocationsList($StateId,$CityId);
		if( $CityId>0 && !empty($CitiesData)){
			$details = array("name"=>"","address"=>"");
			$nameonly = "<option value=0>Select location</option>";
			$address = "";
			$SrNo = 1;
			while($rowdata=mysqli_fetch_array($CitiesData))	{						
				$location = $rowdata['location_name'];
				$nameonly .= "<option value='".$rowdata['id']."'>".$location."</option>";
			}
			$details = array("name"=>$nameonly,"address"=>$address);
		}else{
			$details = array("name"=>0,"address"=>"No data.");
		}
		echo json_encode($details);
	break;
	case "GetLocationAddress":
		$LocationId = $_POST['LocationId'];
		$CitiesData = $Exec->getLocationDetails($LocationId);
		if(!empty($CitiesData)){
			$details = array("address"=>"");
			while($rowdata=mysqli_fetch_array($CitiesData))	{						
				$location = $rowdata['location_name'];
				$address = $location."<br>".$rowdata['address']."<br>".$rowdata['postal_code']."<br>".$rowdata['contact'];
				$details = array("address"=>$address);			
			}
			echo json_encode($details);
		}else{
			echo "No data.";
		}
	break;	
	Default:
		echo "No url found";
	break;
}
?>