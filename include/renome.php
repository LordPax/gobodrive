<?php
	session_start();
	if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] >= 0 && isset($_POST['membre']) && !empty($_POST['membre']) && $_POST['membre'] == $_SESSION['id']){
		include('bdd.php');
		$renome = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
		$renome->execute(array($_POST['id'], $_SESSION['id']));
		$donnees = $renome->fetch();
		$nom = explode('.', $donnees['nom']);
		echo '
			<div class = "bg_spe renome">
				<div class = "fen_comm">
					<div class = "fermer_spe fermer_renome"><label>X</label></div>
					<div class = "titre_comm">renommé</div>
					<div class = "cont_comm">
						<form action = "" method = "post">
							<input type = "hidden" name = "id" value = "'.$_POST['id'].'">
							<input type = "hidden" name = "membre" value = "'.$_SESSION['id'].'">
							<input type = "text" value = "'.$nom[0].'" class = "texte place" name = "nom" placeholder = "nouveau nom">
							<input type = "submit" class = "bouton place" name = "valid" value = "renommé">
						</form>
					</div>
				</div>
			</div>
		';
	}
?>
