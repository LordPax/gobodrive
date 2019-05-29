<?php
	include('../include/bdd.php');
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
		include('../include/visite.php');
	}
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - a propos</title>
		<link rel = "stylesheet" href = "../include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
		<?php include('../include/adsense.php');?>
	</head>
	<body>
		<header>
			<nav>
				<div class = "haut">
					<a class = "lienTitre" href = "<?php echo $domain;?>"><span style = "font-variant : small-caps">GOBO</span> drive</a>
					<?php
						if(isset($_SESSION['id']) && isset($_GET['membre']) && $_SESSION['id'] == $_GET['membre']){
							echo'<img class = "avatar" src = "../images/imgAvatar/'.$info['avatar'].'">';
						}
					?>
					
				</div>
				<div class = "bas">
					<img src = "../images/img_par.png" class = "img_par img_par2">.
				</div>
			</nav>
		</header>
		<?php include('../include/param.php');?>
		<section class = "princip princip_taille">
			<div class = "actu">
				<div class = "fen_param">
					<div class = "titre_param">Description</div>
					<div class = "cont_param">
						Bienvenue sur Gobo drive. Ce site est un hebergeur de fichier en ligne, vous pourrez y enregistrer et partager vos fichiers sur votre compte Gobo drive.
					</div>
				</div>
				<div class = "fen_param">
					<div class = "titre_param">Auteur</div>
					<div class = "cont_param">
						 <table style = "width : 100%">
							<tr class = "auteur">
								<td class = "auteur2"><a class = "lien1" title = "mon CV de codeur" href = "#">Teddy GAUTHIER</a></td>
								<td class = "auteur2">programmeur</td>
								<td class = "auteur2">fondateur</td>
							</tr>
							<tr class = "auteur">
								<td class = "auteur2"><a class = "lien1" href = "#">Florian ROBINEAU</a></td>
								<td class = "auteur2">directeur financier</td>
								<td class = "auteur2">fondateur</td>
							</tr>
						</table>
					</div>
				</div>
				<div class = "fen_param">
					<div class = "titre_param">Nous contacter</div>
					<div class = "cont_param">
						Pour toute demande, question ou autre en rapport avec ce site, veuillez envoyer un mail a l'adresse suivante : <br/>teddy.gauthier@outlook.com
					</div>
				</div>
			</div>
		</section>
		<footer>
			<!--<div class = "foot">Copyright &copy Gobo | <a href = "../apropos.php" class = "lien">a propos</a> </div>-->
		</footer>
	</body>
</html>
