<?php
	include "fonction.php";
	
	// controle de reception de parametre
	if(isset($_REQUEST["operation"])){
		
		// demande de recuperation du dernier profil
		if($_REQUEST["operation"]=="dernier"){
			
			try{
				
				print ("dernier%");
				$cnx = connexionPDO();
				$req = $cnx->prepare("SELECT * FROM profil order by AdressePostal DESC");
				$req->execute();
				// s'il y a un profil, récupération du premier
				if($ligne = $req->fetch(PDO::FETCH_ASSOC)){
					print(json_encode($ligne));
				}
				
			}catch(PDOException $e){
				print "Erreur !".$e->getMessage();
				die();
			}
			
		// enregistrement nouveau profil
		}elseif($_REQUEST["operation"]=="enreg"){
			
			try{
				
				// récupération des données en POST
				$lesdonnees = $_REQUEST["lesdonnees"];
				$donnee = json_decode($lesdonnees);
				$AdressePostal = $donnee[0];
				$estirev = $donnee[1];
				$estifacade = $donnee[2];
				$estirevetement = $donnee[3];
				$estimur = $donnee[4];
				$estiplafond = $donnee[5];
				$estitoiture = $donnee[6];
				
				// insertion dans la BDD
				print("enreg%");
				$cnx = connexionPDO();
				$larequete = "insert into profil (AdressePostal, estirev, estifacade, estirevetement, estimur, estiplafond, estitoiture)";
				//$larequete .= "values ($adressepostal, $estirev, $estifacade, $estirevetement, $estimur, $estiplafond, $estitoiture)";
				$larequete .= "values ('s', $estirev, $estifacade, $estirevetement, $estimur, $estiplafond, $estitoiture)";
				print($larequete);
				$req = $cnx->prepare($larequete);
				$req->execute();
				
			}catch(PDOException $e){
				print "Erreur !%".$e->getMessage();
				die();
			}
			
		}elseif($_REQUEST["operation"]=="tous"){
		
			try{	
				print ("tous%");
				$cnx = connexionPDO();
				$req = $cnx->prepare("SELECT * FROM profil order by AdressePostal DESC");
				$req->execute();
				// Récupération de tous les profils
				while($ligne = $req->fetch(PDO::FETCH_ASSOC)){
					$resultat[] = $ligne;
				}
				print(json_encode($resultat));
			}catch(PDOException $e){
				print "Erreur !%".$e->getMessage();
				die();
			}
			
			}elseif($_REQUEST["operation"]=="del"){
			
			try{
				
				// récupération des données en POST
				$lesdonnees = $_REQUEST["lesdonnees"];
				$donnee = json_decode($lesdonnees);
				$AdressePostal = $donnee[0];
				
				// suppression dans la BDD
				print("del%");
				$cnx = connexionPDO();
				$larequete = "delete from profil where AdressePostal=\"$AdressePostal\"";
				print($larequete);
				$req = $cnx->prepare($larequete);
				$req->execute();
				
			}catch(PDOException $e){
				print "Erreur !%".$e->getMessage();
				die();
			}
		}
	}
?>