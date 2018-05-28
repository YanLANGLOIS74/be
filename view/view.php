<?php
	displayHtmlHeader();
	displayMenu();
	
	if ($page == "authentification")
		displayAuthentification();
	else if ($page == "accueil")
		displayAccueil();
	else if ($page == "listeCommandesEnCours")
		displayListeCommandesEnCours();
	else if ($page == "listeCommandesAchevees")
		displayListeCommandesAchevees();
	else if ($page == "detailCommande")
		displayDetailCommande();
	else if ($page == "listeCommandesTechniciens")
		displayListeCommandesTechniciens();
	else if ($page == "modifierStatutCommande")
		displayModifierStatutCommande();
	else 
		displayAuthentification();

	displayHtmlFooter();
?>