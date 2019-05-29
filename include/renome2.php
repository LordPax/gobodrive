<?php
	if(isset($_POST['valid'])){
		if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] >= 0 && isset($_POST['membre']) && !empty($_POST['membre']) && $_POST['membre'] == $_SESSION['id']){
			if(!empty($_POST['nom']) && isset($_POST['nom'])){
				include('bdd.php');
				$nom = htmlspecialchars($_POST['nom']);
				$ancien = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
				$ancien->execute(array($_POST['id'], $_SESSION['id']));
				$verif = $ancien->rowCount();
				if($verif == 1){
					$donnees = $ancien->fetch();
					$extension = substr(strrchr($donnees['nom'], '.'), 1);
					$chemain1 = '../fichier/'.$_SESSION['id'].'/'.$donnees['nom'];
					$chemain2 = '../fichier/'.$_SESSION['id'].'/'.$nom.'.'.$extension;
					$nouv = $nom.'.'.$extension;
					$verif = $bdd->prepare('SELECT nom FROM fichier WHERE NOT(id = ?) AND nom = ? AND lien_id = ?');
					$verif->execute(array($_POST['id'], $nouv, $_SESSION['id']));
					$nb = $verif->rowCount();
					if($nb == 0){
						$marche = rename($chemain1, $chemain2);
						if($marche){
							$renome = $bdd->prepare('UPDATE fichier SET nom = ? WHERE id = ?');
							$renome->execute(array($nouv, $_POST['id']));
							$msgBonDoc = 'Le fichier '.$donnees['nom'].' a bien été renommer en '.$nouv;
						}
						else{
							$msgErrDoc = 'Une erreure est survenue l\'or du ronommage';
						}
					}
					else{
						$msgErrDoc = 'Un autre fichier de nomme déjà '.$nouv;
					}
				}
				else{
					$msgErrDoc = 'Le fichier '.$nouv.' n\'existe pas, il ne peut donc pas être renommé';
				}
			}
			else{
				$msgErrDoc = 'Veulliez remplir le champ nouveaux nom';
			}
		}
	}
?>
