<?php
ob_start();
session_start();
ini_set('memory_limit', '-1');
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = '';
$DB_name = "gym_db";
try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name};charset=utf8",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$DB_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

include 'class.user.php';
$user = new USER($DB_con);
define('site_url', 'http://localhost/fitness/backend');
define('base_url', 'http://localhost/fitness/backend');
define('SITEURL', 'http://localhost/fitness/');
define('SITENAME', 'FITNESS FREAK');


ob_end_flush();



?>
