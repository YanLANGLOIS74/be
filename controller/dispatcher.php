<?php
	if($_SESSION["connect"] == false) {
		$page = "authentification";
	} else {
		if(isset($_GET["page"])) {
			$page = $_GET["page"];
		} else {
			$page = "accueil";
		}
	} 
?>