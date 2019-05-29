<?php
	session_start();
	include('bdd.php');
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] == $_SESSION['id'] && isset($_GET['id']) && !empty($_GET['id']) && $_GET['membre'] >= 0){
		$mode = $bdd->prepare('SELECT partage FROM fichier WHERE id = ? AND lien_id = ?');
		$mode->execute(array($_GET['id'], $_SESSION['id']));
		$verif = $mode->rowCount();
		if($verif == 1){
			$partage = $mode->fetch();
			if($partage['partage'] == 0){
				$partageOk = $bdd->prepare('UPDATE fichier SET partage = ? WHERE id = ?');
				$partageOk->execute(array(1, $_GET['id']));
			}
			else{
				$partageOk = $bdd->prepare('UPDATE fichier SET partage = ? WHERE id = ?');
				$partageOk->execute(array(0, $_GET['id']));
			}
		}
	}
	header('location:'.$domain.'/bureau/?membre='.$_SESSION['id']);
?>
