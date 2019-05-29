<?php
	if(isset($_POST['suppre'])){
		if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] >= 0 && isset($_POST['membre']) && !empty($_POST['membre']) && $_POST['membre'] == $_SESSION['id']){
			$fic = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
			$fic->execute(array($_POST['id'], $_SESSION['id']));
			$verif = $fic->rowCount();
			if($verif == 1){
				$donnees = $fic->fetch();
				$ok = unlink('../fichier/'.$_SESSION['id'].'/'.$donnees['nom']);
				if($ok){
					$suppre = $bdd->prepare('DELETE FROM fichier WHERE id = ?');
					$suppre->execute(array($_POST['id']));
					$msgBonDoc = 'Le fichier '.$donnees['nom'].' a été supprimer avec succès';
				}
				else{
					$msgErrDoc = 'Il y a eu une erreur l\'ors de le suppression';
				}
			}
			else{
				$msgErrDoc = 'Le fichier que vous voulez supprimé n\'existe pas';
			}
		}
	}
?>
