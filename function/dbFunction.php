<?php

date_default_timezone_set('EST');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('error_log',date('Y-m-d').'_error.log');
$curdate =  date("Y-m-d H:i:s");
$website_url='https://localhost/fitness/';
$blogs_images_path = $website_url."dashboard/blogimages/";
$CategoryBlogUrl = $website_url."category/";
$SingleBlogUrl = $website_url."blog/";
$host = 'localhost';
$username = 'root';
$dbpassword = '';
$dbname = "gym_db";

function base_url(){
	global $website_url;
	echo $website_url;
}
function site_url(){
	global $website_url;
	echo $website_url;
}
class GlobalClass
{
	private  $mysqli=null;
	private $lastinserted_id=0;
	/***** Create Connection ***/
	function DBConnect()
	{
		try
		{
			global $mysqli;
			global $host;
			global $username;
			global $dbpassword;
			global $dbname;
			$mysqli=new mysqli($host,$username,$dbpassword,$dbname,"3306");
			if(mysqli_connect_errno())
			{
				printf("Connection failed %s\n",mysqli_connect_error());
				exit();
			}
			else
			{
				return 1;
			}
		}
		catch(Exception $ex)
		{
			printf("Error Occured:". $ex);
			exit();
		}
		return 0;
		
	}
	
	/***** function to insert queries ***/
	
	function IUDExecute($query)
	{
		$RowCount=0;
		try
		{
			if($this->DBConnect()==1)
			{
				global $mysqli,$lastinserted_id;				
				$mysqli->query($query);				
				$RowCount=$mysqli->affected_rows;
				$lastinserted_id=$mysqli->insert_id;
			}
		}
		catch(Exception $ex)
		{
			printf("Error Occured:". $ex);
			$RowCount=0;
		}
		$this->DBClose();
		return $RowCount;
		
	}
	
	/***** function to get last inserted ID *****/
	function LastInsertedID()
	{
		global $lastinserted_id;
		return $lastinserted_id;
	}
	
	/***** function to select records ***/
	function FetchRecord($query)
	{
		try
		{
			if($this->DBConnect()==1)
			{
				global $mysqli;
				$ResultSet=$mysqli->query($query);				
			}
		}
		catch(Exception $ex)
		{
			printf("Error Occured:". $ex);
		}
			$this->DBClose();
		return $ResultSet;
	}
	
	/******* function to close db connection *******/
	function DBClose()
	{
		try
		{
			global $mysqli;			
			$mysqli->close();
			$mysqli=null;			
		}
		catch(Exception $ex)
		{
			printf("Error Occured:". $ex);
		}		
	}	
	/**************** Register user ***********/
	function NewUserRegister($data=array())
	{		
		global $curdate;
		if(!empty($data)){
			$randomcode = random_int(100000, 999999);
			$CheckAvailability = $this->UserAlreadyExists($data[1]);
			if($CheckAvailability>0){
				return "NA";
			}else{
				$InsertQry = "insert into tbl_users (name,email,contact,password,registerCode,current_plan,datetime)";
				$InsertQry .= "values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."',$randomcode,'".$data[4]."','$curdate')";
				//echo $InsertQry;die;
				$response = $this->IUDExecute($InsertQry);
				if($response)
				{	
					return $randomcode;
				}
				else{
					return false;
				}
			}
		}
	}	
	
	/**************** Check Users Exists ***********/
	function UserAlreadyExists($email=""){
		$getData = $this->FetchRecord( "SELECT count(1) as cnt FROM tbl_users WHERE email='$email'" );
		while($rowdata=mysqli_fetch_array($getData))	{						
			$ResCnt= $rowdata['cnt'];	
		}
		if($ResCnt>0){
			return true;
		}else{
			return false;
		}
	}
	/**************** Register user ends ***********/
	function getAllUsers()
	{		
		$result=$this->FetchRecord("SELECT * from tbl_users order by DATETIME desc");
		$count=$result->num_rows;
		if($count>0)
		{	
			return $result;
		}
		else{
			return "NO-DATA";
		}
	}	
	
	function pagescount(){
		$pagination = $this->FetchRecord( "SELECT * FROM tbl_users WHERE flag=1" );
		$total_pages = $pagination->num_rows;
		return $total_pages ;
	}

	public function get_blogs_data_pagination($start=0,$end=6){
		$BlogSearchQry = "select * from tbl_users ";
		$BlogSearchQry .= " ORDER BY b.datetime DESC limit $start,$end";
		//echo $BlogSearchQry;
		$result=$this->FetchRecord($BlogSearchQry);
		$count=$result->num_rows;
		if($count>0)
		{
			return $result;		
		}
		else{
			return "NO-DATA";
		}
	}
	
	/*******************************************************/
	function getStatesList($CountryId=2)
	{		
		$result=$this->FetchRecord("select * from tbl_states where country_id='$CountryId' ");
		$count=$result->num_rows;
		if($count>0)
		{	
			return $result;
		}
		else{
			return "NO-DATA";
		}
	}	
	/*******************************************************/
	function getCitiesList($StateId=4)
	{		
		$result=$this->FetchRecord("select * from tbl_cities where state_id='$StateId' ");
		$count=$result->num_rows;
		if($count>0)
		{	
			return $result;
		}
		else{
			return "NO-DATA";
		}
	}
	/*******************************************************/
	function getLocationsList($StateId,$CityId,$cols="*")
	{		
		$result=$this->FetchRecord("select $cols from tbl_locations where state_id=$StateId and city_id=$CityId ");
		$count=$result->num_rows;
		if($count>0)
		{	
			return $result;
		}
		else{
			return "NO-DATA";
		}
	}
	/******************** Only Location Address ************************/
	function getLocationDetails($LocationId)
	{		
		$result=$this->FetchRecord("select * from tbl_locations where id=$LocationId ");
		$count=$result->num_rows;
		if($count>0)
		{	
			return $result;
		}
		else{
			return "NO-DATA";
		}
	}
}
?>
