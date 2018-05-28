<?php
	class Bdd {
	
		public static function Connexion() {	
			$_SESSION["success"] = false;
			$resultatUtilisateur = dbConnexion()->prepare("SELECT * FROM utilisateur;");
			$resultatUtilisateur->execute();
				
			foreach($resultatUtilisateur as $row) {
				$identifiant = $_POST["form-username"];
				$identifiantBdd = $row["identifiantUtilisateur"];

				$password = $_POST["form-password"];
				$passwordBdd = $row["motDePasseUtilisateur"];
					
				if($identifiant == $identifiantBdd AND $password == $passwordBdd) {
					//Connexion réussie
					$_SESSION["success"] = true;
					
					//Initialisation de la variable de session
					$_SESSION["connect"] = true;
					
					//Mise en mémoire des données liées au profil connecté
					$_SESSION["idUtilisateur"] = $row["idUtilisateur"];
					$_SESSION["identifiantUtilisateur"] = $row["identifiantUtilisateur"];
					$_SESSION["motDePasseUtilisateur"] = $row["motDePasseUtilisateur"];
					$_SESSION["nomUtilisateur"] = $row["nomUtilisateur"];
					$_SESSION["prenomUtilisateur"] = $row["prenomUtilisateur"];
					$_SESSION["statutUtilisateur"] = $row["statutUtilisateur"];
				}
			}
			
			if($_SESSION["success"] == true) {
				unset($_SESSION["success"]);
				
				header("Location: ./?page=accueil");
				exit;
			} else {
				$_SESSION["error"] = "Identifiant ou mot de passe incorrect";
					
				header("Location: ./?page=authentification");
				exit;
			}
		}
		
		public static function Deconnexion() {
			$_SESSION["connect"] = false;
			header("Location: ./?page=authentification");
			exit;
		}
		
		public static function ReceptionCommande() {
			$idCommande = $_POST["form-idCommande"];
			
			$updateCommande = dbConnexion()->prepare("UPDATE commande SET statutCommande = ? WHERE idCommande = ?;");
			$updateCommande->execute(array(4, $idCommande));
		
			header("Location: ./?page=listeCommandesAchevees");
			exit;
		}
		
		public static function UploaderDiagnostic() {
			$_SESSION["success"] = true;
			
			$MAX_SIZE = 10485760;
			$EXTENSION_VALIDE = "json";
			
			$selectFichier = dbConnexion()->prepare("SELECT * FROM fichier;");
			$selectFichier->execute();
			
			$numLigneFichier = $selectFichier->rowCount();
			
			if($numLigneFichier > 0) {
				foreach($selectFichier as $rowFichier) {
					$idFichier = htmlspecialchars($rowFichier["idFichier"]);
				}
			} else {
				$idFichier = 0;
			}
			
			$nomFichier = $idFichier + 1;
			
			$extension_upload = strtolower(substr(strrchr($_FILES["form-fichier-diagnostic"]["name"],"."),1));
			$cheminFichier = "./doc/diagnostic/".$nomFichier.".".$extension_upload;
			
			if ($_FILES["form-fichier-diagnostic"]["error"] > 0) {
				$_SESSION["erreur1"] = "Erreur lors du transfert";
				$_SESSION["success"] = false;
			}
			
			if ($_FILES["form-fichier-diagnostic"]["size"] > $MAX_SIZE) {
				$_SESSION["erreur2"] = "Le fichier est trop volumineux (9 Mo MAX)";
				$_SESSION["success"] = false;
			}
			
			if($extension_upload != $EXTENSION_VALIDE) {
				$_SESSION["erreur3"] = "Extension non valide (Fichier JSON uniquement)";
				$_SESSION["success"] = false;
			}
			
			if($_SESSION["success"] == true) {	
				move_uploaded_file($_FILES["form-fichier-diagnostic"]["tmp_name"], $cheminFichier);
				
				$insertFichier = dbConnexion()->prepare("INSERT INTO fichier(cheminFichier, idUtilisateur) VALUES (?, ?);");
				$insertFichier->execute(array($cheminFichier, $_SESSION["idUtilisateur"]));
				
				$fp = file_get_contents($cheminFichier);
				$json_a = json_decode($fp, true);
				
				$tabPieces = $json_a["pieces_a_remplacer"];
				
				$dateCommande = date("Y")."-".date("m")."-".date("d");
				
				$selectCommande = dbConnexion()->prepare("SELECT * FROM commande;");
				$selectCommande->execute();
				
				$numLigneCommande = $selectCommande->rowCount();
				
				if($numLigneCommande > 0) {
					foreach($selectCommande as $rowCommande) {
						$idCommande = htmlspecialchars($rowCommande["idCommande"]);
					}
				} else {
					$idCommande = 0;
				}
				
				$numCommandeDigit = $idCommande + 1;
				$numCommande = "C".$numCommandeDigit;
				
				$_SESSION["numCommande"] = $numCommande;
				
				$insertCommande = dbConnexion()->prepare("INSERT INTO commande(dateCommande, numCommande, statutCommande, idFichier) VALUES (?, ?, ?, ?);");
				$insertCommande->execute(array($dateCommande, $numCommande, 0, $nomFichier));
				
				foreach($tabPieces as $piece) {
					$insertPiece = dbConnexion()->prepare("INSERT INTO piece(libellePiece, idCommande) VALUES (?, ?);");
					$insertPiece->execute(array($piece, $numCommandeDigit));
				}
			}
			
			header("Location: ./?page=accueil");
			exit;
		}
		
		public static function ModifierStatutCommande() {
			$idCommande = $_POST["form-idCommande"];
			$statutCommande = $_POST["form-statutCommande"];
			
			$updateCommande = dbConnexion()->prepare("UPDATE commande SET statutCommande = ? WHERE idCommande = ?;");
			$updateCommande->execute(array($statutCommande, $idCommande));
		
			header("Location: ./?page=listeCommandesTechniciens");
			exit;
		}
	}
?>