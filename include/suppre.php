<?php
	session_start();
	if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] >= 0 && isset($_POST['membre']) && !empty($_POST['membre']) && $_POST['membre'] == $_SESSION['id']){
		include('bdd.php');
		$suppre = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
		$suppre->execute(array($_POST['id'], $_SESSION['id']));
		$donnees = $suppre->fetch();
		$nom = explode('.', $donnees['nom']);
		echo '
			<div class = "bg_spe suppre">
				<div class = "fen_comm">
					<div class = "fermer_spe fermer_suppre"><label>X</label></div>
					<div class = "titre_comm">supprimer</div>
					<div class = "cont_comm">
						<p style = "text-align : center">
							Etes vous sûr de vouloir supprimé '.$donnees['nom'].'
						</p>
						<form action = "" method = "post">
							<input type = "hidden" name = "id" value = "'.$_POST['id'].'">
							<input type = "hidden" name = "membre" value = "'.$_SESSION['id'].'">
							<input type = "submit" class = "bouton2 place" name = "suppre" value = "supprimer">
						</form>
						<button class = "bouton place fermer_suppre">annuler</button>
					</div>
				</div>
			</div>
		';
	}
?>
