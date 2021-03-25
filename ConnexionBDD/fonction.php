<?php
	function connexionPDO(){
		
		$login = "root";
		$mdp = "root";
		$db = "test";
		$serveur = "localhost";
		try{
			$conn = new PDO("mysql:host=$serveur;dbname=$db", $login, $mdp);
			return $conn;
		}catch(PDOException $e){
			print "Erreur de connexion PDO";
			die();
		}
	}
?>