<?php
	if(isset($_POST['import'])){
		if(isset($_FILES['doc']) && !empty($_FILES['doc']['name'])){
			$taillePers = $bdd->prepare('SELECT taille_max FROM utilisateur WHERE id = ?');
			$taillePers->execute(array($_SESSION['id']));
			$taillePersNum = $taillePers->fetch();
			$tailleFic = $bdd->prepare('SELECT SUM(taille) AS tailleFic FROM fichier WHERE lien_id = ?');
			$tailleFic->execute(array($_SESSION['id']));
			$tailleFicNum = $tailleFic->fetch();
			$tailleAccepte = $_FILES['doc']['size'] + $tailleFicNum['tailleFic'];
			
			if(isset($_POST['nom']) && !empty($_POST['nom'])){
				$nom_spe = htmlspecialchars($_POST['nom']);
				$extension = substr(strrchr($_FILES['doc']['name'], '.'), 1);
				$chemain = '../fichier/'.$_SESSION['id'].'/'.$nom_spe.'.'.$extension;
				$nom = $nom_spe.'.'.$extension;
			}
			else{
				$chemain = '../fichier/'.$_SESSION['id'].'/'.$_FILES['doc']['name'];
				$nom = $_FILES['doc']['name'];
			}
			
			$fichier = $bdd->prepare('SELECT nom FROM fichier WHERE nom = ?');
			$fichier->execute(array($nom));
			$contNom = $fichier->rowCount();
			
			if($contNom == 0){
				if($tailleAccepte <= $taillePersNum['taille_max']){
					$upload = move_uploaded_file($_FILES['doc']['tmp_name'], $chemain);
					if($upload){
						$doc = $bdd->prepare('INSERT INTO fichier(nom, lien_id, taille) VALUES(?, ?, ?)');
						$doc->execute(array($nom, $_SESSION['id'], $_FILES['doc']['size']));
						$msgBonDoc = 'Votre fichier a bien été importé';	
					}
					else{
						$msgErrDoc = 'Il y a eu une erreur lors de l\'importation de votre fichier';
					}
				}
				else{
					$msgErrDoc = 'Vous n\'avez plus asser d\'espace de stockage';
				}
			}
			else{
				$remplace = $bdd->prepare('SELECT * FROM fichier WHERE nom = ? AND lien_id = ?');
				$remplace->execute(array($nom, $_SESSION['id']));
				$id = $remplace->fetch();
				//$msgErrDoc = 'Il existe déjà un fichier qui se nomme '.$nom.'<a href = "remplace.php?membre='.$_SESSION['id'].'&id='.$id['id'].'&tmp='.$_FILES['doc']['tmp_name'].'" class = "lien1 droite">remplacer</a>';
				$msgErrDoc = 'Il existe déjà un fichier qui se nomme '.$nom;
			}
		}
		else{
			$msgErrDoc = 'Veuillez selectionnez un fichier pour l\'importer';
		}	
	}	
?>
