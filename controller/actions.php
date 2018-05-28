<?php		
	if (isset($_POST["action"])) {			
		if($_POST["action"] == "Connexion")
		{
			bdd::Connexion();
		}
		
		if($_POST["action"] == "Deconnexion")
		{
			bdd::Deconnexion();
		}
		
		if($_POST["action"] == "ReceptionCommande")
		{
			bdd::ReceptionCommande();
		}
		
		if($_POST["action"] == "UploaderDiagnostic")
		{
			bdd::UploaderDiagnostic();
		}
		
		if($_POST["action"] == "ModifierStatutCommande")
		{
			bdd::ModifierStatutCommande();
		}
	}
?>