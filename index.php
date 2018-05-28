<?php	
	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', true);
	
	include_once "config.php";
	include_once "db.php";
	include_once "model/bdd.php";
	
	session_start();
	
	if(!isset($_SESSION["connect"]))
	{
		$_SESSION["connect"] = false;
	}
	
	include_once "controller/actions.php";
	include_once "controller/dispatcher.php";
	include_once "view/systemGeneralFunctions.php";
	include_once "view/displayGeneralFunctions.php";
	include_once "view/view.php";
?>