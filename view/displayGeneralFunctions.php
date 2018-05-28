<?php
	//Vue du header HTML
	function displayHtmlHeader() {
		global $page;
		
		echo "<!DOCTYPE html5>";
		echo "<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='fr'>";
		
			echo "<head>";
				
				//Encodage et zoom
				echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
				echo "<meta name='viewport' content='width=device-width, initial-scale=1.0' />";
				echo "<meta http-equiv='X-UA-Compatible' content='IE=edge' />";
				
				//Titre de la page
				echo "<title>Gestion maintenances | Best Engines Inc.</title>";
				
				//Description et auteur de la page
				echo "<meta name='description' content='Application de gestion des maintenances de la société Best Engines Inc.' />";
				echo "<meta name='author' content='Best Engines Inc.' />";
				
				//Fichiers CSS
				echo "<link href='config/css/bootstrap.min.css' rel='stylesheet' />";
				echo "<link href='config/css/animate.css' rel='stylesheet' />";
				echo "<link href='config/css/styles.css' rel='stylesheet' />";
				
				//Formulaire d'authentification
				if($page == "authentification") {
					echo "<link rel='stylesheet' href='config/font-awesome/css/font-awesome.min.css' />";
					echo "<link rel='stylesheet' href='config/css/authentification/form-elements.css' />";
					echo "<link rel='stylesheet' href='config/css/authentification/style.css' />";
					
					echo "<!--[if lt IE 9]>";
						echo "<script src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'></script>";
						echo "<script src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'></script>";
					echo "<![endif]-->";
				}
				
				//Font
				echo "<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Montserrat' />";
				
				//Favicon
				echo "<link href='doc/img/favicon/favicon.png' rel='shortcut icon' />";

			echo "</head>";			
			echo "<body>";
	}
	
	//Vue de la page d'authentification
	function displayAuthentification() {
		if($_SESSION["connect"] == false) {
			echo "<div class='top-content'>";
				echo "<div class='inner-bg'>";
					echo "<div class='container'>";
						echo "<div class='row'>";
							echo "<div class='col-sm-6 col-sm-offset-3 form-box'>";
								echo "<div class='form-top'>";
									echo "<div class='form-top-left'>";
										echo "<img alt='Brand' src='doc/img/logo.png' width='220px;'>";
									echo "</div>";
									echo "<div class='form-top-right'>";
									echo "</div>";
								echo "</div>";
								echo "<div class='form-bottom'>";
									echo "<form role='form' action='.' method='post' class='login-form'>";
										echo "<div class='form-group'>";
											echo "<label class='sr-only' for='form-username'>Identifiant</label>";
											echo "<input type='text' name='form-username' placeholder='Identifiant' class='form-username form-control' id='form-username'>";
										echo "</div>";
										echo "<div class='form-group'>";
											echo "<label class='sr-only' for='form-password'>Mot de passe</label>";
											echo "<input type='password' name='form-password' placeholder='Mot de passe' class='form-password form-control' id='form-password'>";
										echo "</div>";
										echo "<button class='btn' type='submit' name='action' value='Connexion'>S'authentifier</button>";
									echo "</form>";
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				echo "</div>"; 
			echo "</div>";
		} else {
			header("Location: ./?page=accueil");
			exit;
		}
	}
	
	//Vue du menu
	function displayMenu() {
		global $page;
		
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true) {	
		
			if($page == "listeCommandesEnCours" OR $page == "listeCommandesAchevees" OR $page == "listeCommandesTechniciens")
				$listeCommandes = "active";
			else
				$listeCommandes = "";
			
			if($page == "accueil")
				$accueil = "active";
			else
				$accueil = "";
			
			//Affichage du menu
			echo "<nav class='navbar navbar-default navbar-fixed-top'>";
				echo "<div class='container'>";
					echo "<div class='navbar-header'>";
						echo "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar-collapse-1'>";
							echo "<span class='sr-only'>Toggle navigation</span>";
							echo "<span class='icon-bar'></span>";
							echo "<span class='icon-bar'></span>";
							echo "<span class='icon-bar'></span>";
						echo "</button>";
						echo "<a class='navbar-brand' href='./?page=accueil'>";
							echo "<img alt='Brand' src='doc/img/logoBis.png' width='250px;'>";
						echo "</a>";
					echo "</div>";
					
					echo "<div class='collapse navbar-collapse' id='navbar-collapse-1'>";
						echo "<ul class='nav navbar-nav'>";
							echo "<li class='".$accueil."'><a href='./?page=accueil'><span class='glyphicon glyphicon-home' aria-hidden='true'></span>&nbsp;&nbsp;Accueil</a></li>";
							
							if($_SESSION["statutUtilisateur"] == 0) {
								echo "<li class='dropdown ".$listeCommandes."'>";
									echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span class='glyphicon glyphicon-th-list' aria-hidden='true'></span>&nbsp;&nbsp;Liste des commandes <span class='caret'></span></a>";
									echo "<ul class='dropdown-menu'>";
										echo "<li><a href='./?page=listeCommandesEnCours'><span class='glyphicon glyphicon-repeat' aria-hidden='true'></span>&nbsp;&nbsp;En cours</a></li>";
										echo "<li><a href='./?page=listeCommandesAchevees'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span>&nbsp;&nbsp;Achevees</a></li>";
									echo "</ul>";
								echo "</li>";
							}
							
							if($_SESSION["statutUtilisateur"] == 1) {
								echo "<li class='".$listeCommandes."'><a href='./?page=listeCommandesTechniciens'><span class='glyphicon glyphicon-th-list' aria-hidden='true'></span>&nbsp;&nbsp;Liste des commandes</a></li>";
							}
							
						echo "</ul>";
						
						echo "<form action='.' method='post'>";
							echo "<ul class='nav navbar-nav navbar-right'>";
							echo "<button type='submit' class='btn btn-danger navbar-btn ml-s' name='action' value='Deconnexion'><span class='glyphicon glyphicon-off' aria-hidden='true'></span>&nbsp;&nbsp;Se déconnecter</button>";	
							echo "</ul>";
						echo "</form>";
					echo "</div>";
				echo "</div>";
			echo "</nav>";
		}
	}
	
	//Vue du la page d'accueil
	function displayAccueil() {
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true) {
			$compte = "";
			
			if($_SESSION["statutUtilisateur"] == 1) {
				$compte = "technicien";
			} else if($_SESSION["statutUtilisateur"] == 0) {
				$compte = "client";
			}
			echo "<div class='container bloc-top'>";
				echo "<div class='row'>";
					echo "<div class='col-md-12'>";
						echo "<div class='jumbotron'>";
							echo "<h1>Bienvenue</h1>";
							echo "<p>";
								echo "Sur l'application de gestion des maintenances de la société Best Engines Inc.<br/>";
								echo "<span class='size-s'>Vous êtes connecté avec un compte <b>".$compte."</b></span><br/>";
								echo "<span class='size-s'>Application mise à jour le <b>18/01/2018</b></span>";
							echo "</p>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
				
				if($_SESSION["statutUtilisateur"] == 0) {
					echo "<div class='row size-s mt-s'>";
						echo "<div class='col-md-12'>";
						
						if(isset($_SESSION["success"])) {
							if($_SESSION["success"] == false) {
								if(isset($_SESSION["erreur1"])) {
									echo "<div class='alert alert-danger alert-dismissible' role='alert'>";
										echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
										echo "<strong>Erreur: </strong>".$_SESSION["erreur1"];
									echo "</div>";
									
									unset($_SESSION["erreur1"]);
								}
								
								if(isset($_SESSION["erreur2"])) {
									echo "<div class='alert alert-danger alert-dismissible' role='alert'>";
										echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
										echo "<strong>Erreur: </strong>".$_SESSION["erreur2"];
									echo "</div>";
									
									unset($_SESSION["erreur2"]);
								}
								
								if(isset($_SESSION["erreur3"])) {
									echo "<div class='alert alert-danger alert-dismissible' role='alert'>";
										echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
										echo "<strong>Erreur: </strong>".$_SESSION["erreur3"];
									echo "</div>";
									
									unset($_SESSION["erreur3"]);
								}
							} else {
								echo "<div class='alert alert-success alert-dismissible' role='alert'>";
									echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
									echo "<strong>Fichier de diagnostic chargé avec succès !<br/>La commande n°".$_SESSION["numCommande"]." a été créée.</strong>";
								echo "</div>";
							}
							
							unset($_SESSION["success"]);
						}
							
						echo "</div>";
					echo "</div>";
					
					echo "<div class='row mt-s'>";
						echo "<div class='col-md-12'>";
							echo "<div class='jumbotron'>";
								echo "<p>";
									echo "<b>Vous êtes victime d'une panne ?</b><br/>";
									echo "<span class='size-s'>Cliquez sur le bouton suivant pour charger votre fichier de diagnostic et ainsi déclencher la création d'une commande :</span><br/>";
									echo "<form method='post' action='.' enctype='multipart/form-data'>";
										echo "<input type='file' class='form-control' name='form-fichier-diagnostic' id='form-fichier-diagnostic' style='width: 500px;'><br/>";
										echo "<button type='submit' class='btn btn-success'><span class='glyphicon glyphicon-import' aria-hidden='true'></span>&nbsp;&nbsp;Charger le diagnostic</button>";
										echo "<input type='hidden' name='action' value='UploaderDiagnostic' />";
									echo "</form>";
								echo "</p>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
				}
			echo "</div>";
		}
	}
	
	//Vue du la liste des commandes en cours
	function displayListeCommandesEnCours() {
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true AND $_SESSION["statutUtilisateur"] == 0) {
			echo "<div class='container bloc-top'>";
				echo "<div class='row'>";
					echo "<div class='col-md-6'>";
						echo "<h2>Liste des commandes en cours</h2>";
					echo "</div>";
				echo "</div>";
				
				echo "<div class='row mt-s'>";
					echo "<div class='col-md-12'>";
						echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered center'>";
								echo "<thead>";
									echo "<tr class='bg-grey'>";
										echo "<th class='center'>Date</th>";
										echo "<th class='center'>Numéro</th>";
										echo "<th class='center'>Statut</th>";
										echo "<th class='center'>Actions</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								
								$selectListeCommandesEnCours = dbConnexion()->prepare("SELECT * FROM fichier f JOIN commande c ON f.idFichier = c.idFichier WHERE c.statutCommande <> 4 AND f.idUtilisateur = ".$_SESSION["idUtilisateur"]." ORDER BY c.dateCommande, c.numCommande;");
								$selectListeCommandesEnCours->execute();
								
								foreach($selectListeCommandesEnCours as $rowListeCommandesEnCours) {
									$idCommande = htmlspecialchars($rowListeCommandesEnCours["idCommande"]);
									$dateCommande = htmlspecialchars($rowListeCommandesEnCours["dateCommande"]);
									$numCommande = htmlspecialchars($rowListeCommandesEnCours["numCommande"]);
									$statutCommande = htmlspecialchars($rowListeCommandesEnCours["statutCommande"]);
									
									$dateCommande = explode("-", $dateCommande);
									$dateCommande = $dateCommande[2]."/".$dateCommande[1]."/".$dateCommande[0];
									
									if($statutCommande == 0) {
										$color = "danger";
										$statut = "En attente de préparation";
									} else if($statutCommande == 1) {
										$color = "warning";
										$statut = "En cours de préparation";
									} else if($statutCommande == 2) {
										$color = "warning";
										$statut = "Prête à être expédiée";
									} else if($statutCommande == 3) {
										$color = "success";
										$statut = "Expédiée";
									} else {
										$color = "";
										$statut = "N/C";
									}
									
									echo "<tr>";
										echo "<td>".$dateCommande."</td>";
										echo "<td>N°".$numCommande."</td>";
										echo "<td class='".$color."'>".$statut."</td>";
										echo "<td>";
											echo "<div class='col-md-6'>";
												echo "<a href='./?page=detailCommande&idCommande=".$idCommande."' class='btn btn-primary btn-block'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>&nbsp;&nbsp;Détails</a>";
											echo "</div>";
											echo "<div class='col-md-6'>";
											
												if($statutCommande == 3) {
													echo "<form method='post' action='.'>";
														echo "<input type='hidden' name='form-idCommande' value='".$idCommande."' />";
														echo "<button type='submit' class='btn btn-success btn-block'><span class='glyphicon glyphicon-thumbs-up' aria-hidden='true'></span>&nbsp;&nbsp;Reçu ?</button>";
														echo "<input type='hidden' name='action' value='ReceptionCommande' />";
													echo "</form>";
												}
												
											echo "</div>";										
										echo "</td>";
									echo "</tr>";
								}
								
								echo "</tbody>";
							echo "</table>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	}
	
	//Vue du la liste des commandes achevées
	function displayListeCommandesAchevees() {
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true AND $_SESSION["statutUtilisateur"] == 0) {
			echo "<div class='container bloc-top'>";
				echo "<div class='row'>";
					echo "<div class='col-md-6'>";
						echo "<h2>Liste des commandes achevées</h2>";
					echo "</div>";
				echo "</div>";
				
				echo "<div class='row mt-s'>";
					echo "<div class='col-md-12'>";
						echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered center'>";
								echo "<thead>";
									echo "<tr class='bg-grey'>";
										echo "<th class='center'>Date</th>";
										echo "<th class='center'>Numéro</th>";
										echo "<th class='center'>Statut</th>";
										echo "<th class='center'>Actions</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								
								$selectListeCommandesAchevees = dbConnexion()->prepare("SELECT * FROM fichier f JOIN commande c ON f.idFichier = c.idFichier WHERE c.statutCommande = 4 AND f.idUtilisateur = ".$_SESSION["idUtilisateur"]." ORDER BY c.dateCommande, c.numCommande;");
								$selectListeCommandesAchevees->execute();
								
								foreach($selectListeCommandesAchevees as $rowListeCommandesAchevees) {
									$idCommande = htmlspecialchars($rowListeCommandesAchevees["idCommande"]);
									$dateCommande = htmlspecialchars($rowListeCommandesAchevees["dateCommande"]);
									$numCommande = htmlspecialchars($rowListeCommandesAchevees["numCommande"]);
									$statutCommande = htmlspecialchars($rowListeCommandesAchevees["statutCommande"]);
									
									$dateCommande = explode("-", $dateCommande);
									$dateCommande = $dateCommande[2]."/".$dateCommande[1]."/".$dateCommande[0];
									
									if($statutCommande == 4) {
										$color = "danger";
										$statut = "Achevée";
									} else {
										$color = "";
										$statut = "N/C";
									}
									
									echo "<tr>";
										echo "<td>".$dateCommande."</td>";
										echo "<td>N°".$numCommande."</td>";
										echo "<td class='".$color."'>".$statut."</td>";
										echo "<td>";
											echo "<a href='./?page=detailCommande&idCommande=".$idCommande."' class='btn btn-primary btn-block'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>&nbsp;&nbsp;Détails</a>";								
										echo "</td>";
									echo "</tr>";
								}
								
								echo "</tbody>";
							echo "</table>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	}
	
	//Vue du détail associé à une commande
	function displayDetailCommande() {
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true) {
			$idCommande = $_GET["idCommande"];
			
			echo "<div class='container bloc-top'>";
				echo "<div class='row'>";
					echo "<div class='col-md-6'>";
						echo "<h2>Liste des pièces commandées</h2>";
					echo "</div>";
				echo "</div>";
				
				echo "<div class='row mt-s'>";
					echo "<div class='col-md-12'>";
						echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered'>";
								echo "<thead>";
									echo "<tr class='bg-grey'>";
										echo "<th>Libellé de la pièce</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								
								$selectListePiecesCommandees = dbConnexion()->prepare("SELECT * FROM piece WHERE idCommande = ? ORDER BY libellePiece;");
								$selectListePiecesCommandees->execute(array($idCommande));
								
								foreach($selectListePiecesCommandees as $rowListePiecesCommandees) {
									$libellePiece = htmlspecialchars($rowListePiecesCommandees["libellePiece"]);
									
									echo "<tr>";
										echo "<td>".$libellePiece."</td>";
									echo "</tr>";
								}
								
								echo "</tbody>";
							echo "</table>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	}
	
	//Vue du la liste des commandes à gérer par les techniciens
	function displayListeCommandesTechniciens() {
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true AND $_SESSION["statutUtilisateur"] == 1) {
			echo "<div class='container bloc-top'>";
				echo "<div class='row'>";
					echo "<div class='col-md-6'>";
						echo "<h2>Liste des commandes</h2>";
					echo "</div>";
				echo "</div>";
				
				echo "<div class='row mt-s'>";
					echo "<div class='col-md-12'>";
						echo "<div class='table-responsive'>";
							echo "<table class='table table-bordered center'>";
								echo "<thead>";
									echo "<tr class='bg-grey'>";
										echo "<th class='center'>Date</th>";
										echo "<th class='center'>Numéro</th>";
										echo "<th class='center'>Statut</th>";
										echo "<th class='center'>Actions</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
								
								$selectListeCommandesEnCours = dbConnexion()->prepare("SELECT * FROM commande ORDER BY statutCommande, dateCommande, numCommande;");
								$selectListeCommandesEnCours->execute();
								
								foreach($selectListeCommandesEnCours as $rowListeCommandesEnCours) {
									$idCommande = htmlspecialchars($rowListeCommandesEnCours["idCommande"]);
									$dateCommande = htmlspecialchars($rowListeCommandesEnCours["dateCommande"]);
									$numCommande = htmlspecialchars($rowListeCommandesEnCours["numCommande"]);
									$statutCommande = htmlspecialchars($rowListeCommandesEnCours["statutCommande"]);
									
									$dateCommande = explode("-", $dateCommande);
									$dateCommande = $dateCommande[2]."/".$dateCommande[1]."/".$dateCommande[0];
									
									if($statutCommande == 0) {
										$color = "danger";
										$statut = "En attente de préparation";
									} else if($statutCommande == 1) {
										$color = "warning";
										$statut = "En cours de préparation";
									} else if($statutCommande == 2) {
										$color = "warning";
										$statut = "Prête à être expédiée";
									} else if($statutCommande == 3) {
										$color = "success";
										$statut = "Expédiée";
									} else if($statutCommande == 4) {
										$color = "danger";
										$statut = "Achevée";
									} else {
										$color = "";
										$statut = "N/C";
									}
									
									echo "<tr>";
										echo "<td>".$dateCommande."</td>";
										echo "<td>N°".$numCommande."</td>";
										echo "<td class='".$color."'>".$statut."</td>";
										echo "<td>";
											echo "<div class='col-md-6'>";
												echo "<a href='./?page=detailCommande&idCommande=".$idCommande."' class='btn btn-primary btn-block'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span>&nbsp;&nbsp;Détails</a>";
											echo "</div>";	
											echo "<div class='col-md-6'>";
												echo "<a href='./?page=modifierStatutCommande&idCommande=".$idCommande."' class='btn btn-warning btn-block'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>&nbsp;&nbsp;Modifier le statut</a>";
											echo "</div>";
										echo "</td>";
									echo "</tr>";
								}
								
								echo "</tbody>";
							echo "</table>";
						echo "</div>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		}
	}
	
	//Vue permettant de modifier le statut d'une commande
	function displayModifierStatutCommande() {
		//On test si l'utilisateur est bien connecté
		if($_SESSION["connect"] == true AND $_SESSION["statutUtilisateur"] == 1) {
			$idCommande = $_GET["idCommande"];
			
			echo "<div class='container bloc-top'>";
				echo "<div class='row'>";
					echo "<div class='col-md-6'>";
						echo "<h2>Modifier le statut de la commande n°C".$idCommande."</h2>";
					echo "</div>";
					echo "<div class='col-md-6 right'>";
						echo "<a href='./?page=listeCommandesTechniciens' class='btn btn-warning'><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span>&nbsp;&nbsp;Retour</a>";
					echo "</div>";
				echo "</div>";
				
				echo "<form method='post' action='.'>";	
					echo "<input type='hidden' name='form-idCommande' value='".$idCommande."' />";
					
					echo "<div class='row mt-s'>";
						echo "<div class='col-md-8'>";
							echo "<div class='form-group'>";
								echo "<div class='form-group'>";
									echo "<div class='input-group'>";
										echo "<span class='input-group-addon'>Etat</span>";
										echo "<select class='form-control' name='form-statutCommande' id='form-statutCommande'>";
											echo "<option value='0'>En attente de préparation</option>";
											echo "<option value='1'>En cours de préparation</option>";
											echo "<option value='2'>Prête à être expédiée</option>";
											echo "<option value='3'>Expédiée</option>";
										echo "</select>";
									echo "</div>";	
								echo "</div>";
							echo "</div>";
						echo "</div>";
					echo "</div>";
					
					echo "<div class='row mt-s'>";
						echo "<div class='col-md-3'>";
							echo "<button type='submit' class='btn btn-success btn-block'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span>&nbsp;&nbsp;Modifier</button>";
							echo "<input type='hidden' name='action' value='ModifierStatutCommande' />";
					echo "</div>";					
				echo "</form>";
			
			echo "</div>";
		}
	}

	function displayHtmlFooter() {
				global $page;
				
				//Fichiers JS
				echo "<script type='text/javascript' src='config/js/jquery.min.js'></script>";
				echo "<script type='text/javascript' src='config/js/bootstrap.min.js'></script>";
				echo "<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.js'></script>";
				echo "<script type='text/javascript' src='config/js/manip.js'></script>";
				
				if($page == "authentification") {
					echo "<script src='config/js/authentification/jquery.backstretch.min.js'></script>";
					echo "<script src='config/js/authentification/scripts.js'></script>";
					
					echo "<!--[if lt IE 10]>";
						echo "<script src='config/js/authentification/placeholder.js'></script>";
					echo "<![endif]-->";
				}
			
			echo "</body>";
		echo "</html>";
	}
?>