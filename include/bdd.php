<?php
	/*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*\
		Instruction :
		 - 1 / Ecrivez le nom d'utilisateur de la base de donnée et le mot de passe correspondant. Gardez "localhost" si la base de donnée est sur le serveur concervant les codes sources, si la base de donnée est sur un autre serveur, mettez l'adresse de ce serveur.
		 
		 - 2 / Ecrivez votre nom de domain, example : $domain = 'http://example.fr'; (si vous avez un certifica SSL, pensez à changer le "http://" en "https://").
		 
	\*=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=*/

	$bdd = new PDO('mysql:host=localhost;dbname=drive','nom_utilisateur','mot_de_passe');
	//connection à la base de donnée, mettez y le nom d'utilisateur de la base de donnée et le mot de passe correspondant
	
	$domain = 'http://nom_de_domain_ici';
	//Ecrivez votre nom de domain à la place de "nom_de_domain_ici"
	
	ini_set("display_errors",0);error_reporting(0);
	//sert a ne pas afficher d'erreur PHP si il y en a, peut décourager certain hacker.
	
	$cle = 'osetJ465Pdofu5y5s46hf4MO1oUQ46Lqu4y65m4l1i6M367H4jhsf54q64d6LzqjOQsyd';
	//clé de chiffrement, ne surtout pas changer
	
	
	$stripe_publishable_key = "pk_test_cIvNF5jyRx65XrPJl0f5kzp9";
	$stripe_secret_key = "sk_test_NtfJUKsZd5F7X8ktfR273Nen";

	
	$img_ext = array('jpg', 'jpeg', 'gif', 'png');
	$vid_ext = array('mp4', 'avi', 'mwv', 'ogg', 'mkv', 'mov', 'mpg');
	$sic_ext = array('mp3', 'mwm');
	$pdf_ext = 'pdf';
	
	//if($_SERVER['HTTPS'] == FALSE)
		//header('location:'.$domain);
?>
