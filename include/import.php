<?php
	echo '
		<div class = "bg_spe importer">
			<div class = "fen_comm">
				<div class = "fermer_spe fermer_import"><label>X</label></div>
				<div class = "titre_comm">importer</div>
				<div class = "cont_comm">
					<form action = "" method = "post" enctype = "multipart/form-data">
						<input type = "text" name = "nom" id = "nom" placeholder = "nom du fichier (si vide, le fichier garde le même nom)" class = "texte place">
						<input type = "file" name = "doc" id = "doc" class = "place">
						<input type = "submit" name = "import" id = "valid" value = "importer" class = "bouton place charge">
					</form>
					<div class = "chargement">
						chargement en cours <img width = "30px" src = "../images/charge.gif">
					</div>
				</div>
			</div>
		</div>
	';
?>
