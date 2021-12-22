<?php
include 'config.php';
if(!isset($_SESSION['loginID']))
{
	$user->redirect();
}
else
{
	$user->logout();
	$user->redirect();
}
?>