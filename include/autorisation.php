<?php
	session_start();
	if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] >= 0 && isset($_POST['membre']) && !empty($_POST['membre']) && $_POST['membre'] == $_SESSION['id']){
		include('bdd.php');
		$partage = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
		$partage->execute(array($_POST['id'], $_SESSION['id']));
		$donnees = $partage->fetch();
		$ext = substr(strrchr($donnees['nom'], '.'), 1);
		echo '
			<div class = "bg_spe partage">
				<div class = "fen_comm">
					<div class = "fermer_spe fermer_partage"><label>X</label></div>
					<div class = "titre_comm">partage</div>
					<div class = "cont_comm">
						<input type = "text" value = "'.$domain.'/partage/?id='.$donnees['id'].'" class = "texte place nom">';
						if(in_array($ext, $vid_ext)){
							echo'<input type = "text" value = "&lt;iframe src = &quot;'.$domain.'/video/?id='.$donnees['id'].'&quot; width = &quot;350px&quot; height = &quot;200px&quot; allowfullscreen frameborder = &quot;0&quot;&gt;&lt;/iframe&gt;" class = "texte place nom">';
						}
						echo'<hr/>
						<div class = "descrip_ligne descrip_ligne3" title = "ceci permet d\'éviter que des fichiers soit télécharger sans votre autorisation">
							<a class = "autorisation ';if($donnees['partage'] == 1) echo'ok';else echo'nope'; echo'" href = "../include/partage.php?id='.$donnees['id'].'&membre='.$_SESSION['id'].'">autoriser le téléchargement</a>
						</div>
					</div>
				</div>
			</div>
		';
	}
?>
