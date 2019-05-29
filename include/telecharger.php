<?php
	session_start();
	if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] == $_SESSION['id']){
		include('bdd.php');
		$fichier = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
		$fichier->execute(array($_GET['id'], $_SESSION['id']));
		$verif = $fichier->rowCount();
		if($verif == 1){
			$nom = $fichier->fetch();
			$nouvNom = str_replace(' ', '_', $nom['nom']);
			header('Cache-Control: public');
			//header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$nouvNom.';');
			readfile('../fichier/'.$_SESSION['id'].'/'.$nom['nom']);
		}
		else{
			header('location:'.$domain.'/bureau/?membre='.$_SESSION['id']);
		}
	}
?>
