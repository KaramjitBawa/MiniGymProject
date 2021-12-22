<?php
class USER
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
		
	}
	public function base_url()
	{
		echo site_url."/";
	}

	public function redirect( $url=null ) {
		if ( $url==null ) {
			
			echo "<script>window.open('login.php','_self');</script>";
   
			exit();	

		}
		else {
			
			echo "<script>window.open('".$url."','_self');</script>";
   
			exit();	

		}

	

	}
	public function GetPlans(){
		$PlansArray = array( "Black Card","Standard Card","4Less Card");
		return $PlansArray;
	}
	
	public function logout()
	{
		$stmt = $this->db->prepare("UPDATE `tbl_users` SET `flag`=0 WHERE `email` =:user_id ");
		$stmt->execute( array( ':user_id' => $_SESSION['loginID'] ) );
		session_destroy();
		unset($_SESSION['loginID']);
	}

	public function get_users(){
	

		$stmt = $this->db->prepare("SELECT * FROM tbl_users");
		$stmt->execute();
		$memb_details = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $memb_details;
	}
	
	public function get_states(){
		$stmt = $this->db->prepare("SELECT * FROM tbl_states");
		$stmt->execute();
		$memb_details = $stmt->fetchAll(PDO::FETCH_OBJ);
		return $memb_details;
	}
	public function getData( $table, $data ) {
		if ( $data != null ) {

			$place_holders = array();
			$get_data = array();

			foreach($data as $key => $value) {

				$place_holders[] = $key.'=:'.$key;
				$get_data[':'.$key] = $value;
			}

			try
				{
					$data_array = implode(',', $place_holders);
					$stmt = $this->db->prepare(" SELECT * FROM $table WHERE $data_array ");
					$stmt->execute($get_data);
					$row = $stmt->fetchAll(PDO::FETCH_OBJ);
					return $row;

				}
				catch(PDOException $e)
				{
					
					echo $e->getMessage();
				
				}
		}
	}
	public function InsertData_without_date( $table, $data = array() )
	{
		
			$cols = array();
			$place_holders = array();

			$insert_data = array();

			foreach($data as $key => $value) {
				$cols[] = $key;
				$place_holders[] = ':'.$key;

				$insert_data[':'.$key] = $value;
			}

			try
				{
					$stmt = $this->db->prepare('INSERT INTO `'.$table.'` (' . implode(',', $cols) . ') VALUES ( ' . implode(',', $place_holders ) . ') ');
					
					$stmt->execute($insert_data);
					return $this->db->lastInsertId();
				}
			catch(PDOException $e)
				{
					echo $e->getMessage();
				}				
	}

	public function deleteFields( $table, $oid=NULL, $col=NULL ) {
		if($oid != NULL){
			try{
				$stmt = $this->db->prepare(" DELETE FROM `$table` WHERE `$col` ='$oid' ");
				$stmt->execute();
				return $stmt; 
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
	public function is_loggedin()

	{	
		if(isset($_SESSION['loginID']))
		{
			return true;
		}
	}
	
	public function getAdmin($id=Null) {
        if ($id!=Null) {
            $user_id = $id;  
            $stmt = $this->db->prepare("SELECT * FROM `tbl_users` WHERE `email`='".$user_id."'");
            $stmt->execute();
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            return $userRow;
        }

    }
	
	public function login($umail,$upass)
	{ 
		try
		 { 
			$stmt = $this->db->prepare("SELECT * from tbl_users WHERE email = '".$umail."' && password = '".$upass."'");
			$stmt->execute();
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount() > 0;
			return $userRow;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function InsertData( $table, $data = array(), $ref )
	{
		
		$cols = array();
		$place_holders = array();
		$insert_data = array();
		foreach($data as $key => $value) {
			$cols[] = $key;
			$place_holders[] = ':'.$key;
			$insert_data[':'.$key] = $value;
		}
		try
		{
			$stmt = $this->db->prepare('INSERT INTO `'.$table.'` (`'.$ref.'`, ' . implode(',', $cols) . ') VALUES (NOW(), ' . implode(',', $place_holders ) . ') ');
			$stmt->execute($insert_data);
			return $this->db->lastInsertId();
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}

	public function AddData( $table, $data = array() )
	{
		
			$cols = array();
			$place_holders = array();

			$insert_data = array();

			foreach($data as $key => $value) {
				$cols[] = $key;
				$place_holders[] = ':'.$key;

				$insert_data[':'.$key] = $value;
			}

			try
				{
				
					$stmt = $this->db->prepare('INSERT INTO `'.$table.'` (' . implode(',', $cols) . ') VALUES (' . implode(',', $place_holders ) . ') ');
					$stmt->execute($insert_data);
					return $stmt;
				}
			catch(PDOException $e)
				{
					echo $e->getMessage();
				}				
	}

	public function getRow( $table, $data ) {
		if ( $data != null ) {

			$place_holders = array();
			$get_data = array();

			foreach($data as $key => $value) {

				$place_holders[] = $key.'=:'.$key;
				$get_data[':'.$key] = $value;
			}

			try
				{
					$data_array = implode(',', $place_holders);
					$stmt = $this->db->prepare(" SELECT * FROM $table WHERE $data_array ");
					$stmt->execute($get_data);
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					return $row;

				}
				catch(PDOException $e)
				{
					
					echo $e->getMessage();
				
				}
		}
	}

	public function updateFields($table, $data = array(), $oid=NULL, $col=NULL ) {
		if ($oid != NULL ) {
			$place_holders = array();
			$insert_data = array();

			foreach($data as $key => $value) {

				$place_holders[] = $key.'=:'.$key;
				$insert_data[':'.$key] = $value;
			}

			try
				{
					$data_array = implode(',', $place_holders);
					
					$stmt = $this->db->prepare(" UPDATE $table SET $data_array WHERE $col='$oid' ");
					$stmt->execute($insert_data);
					return $stmt;

				}
				catch(PDOException $e)
				{
					
					echo $e->getMessage();
				
				}
		}
	}
}
?>