<?php
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && isset($_GET['id']) && !empty($_GET['id']) isset($_GET['tmp']) && !empty($_GET['tmp']) $_GET['id'] >= 0 $_GET['membre'] == $_SESSION['id']){
		$id = $_GET['id'];
		$remplace = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
		$remplace->execute(array($id, $_SESSION['id']));
		$donnees = $remplace->fetch();
		
	}
?>
