<?php
	$dbConnexion = null;
	
	function dbConnexion() {
		global $dbConnexion;
		return $dbConnexion;
	}
	
	try {
		$dbConnexion = new PDO("mysql:host=localhost;dbname=be_engine","root","");
	} catch (Exception $e) {
		die($e->getMessage());	
	}
?>
