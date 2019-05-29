<?php
	include('../include/bdd.php');
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
		include('../include/visite.php');
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - paramètre</title>
		<link rel = "stylesheet" href = "../include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
		<?php include('include/adsense.php');?>
	</head>
	<body>
		<?php include('../include/import.php');?>
		<header>
			<nav>
				<div class = "haut">
					<span style = "font-variant : small-caps">GOBO</span> drive
					<img class = "avatar" src = "../images/imgAvatar/<?php echo $info['avatar'];?>">
				</div>
				<div class = "bas">
					<img src = "../images/img_par.png" class = "img_par img_par2">.
				</div>
			</nav>
		</header>
		<?php include('../include/param.php');?>
		<section class = "princip princip_taille">
			<div class = "actu">
				<div class = "fen_param" style = "min-height : 100px;">
					<div class = "titre_param">Paramètre</div>
					<div class = "cont_param">
						<a class = "button" href = "moncompte/?membre=<?php echo $_SESSION['id'];?>">Mon compte</a>
						<a class = "button" href = "extention/?membre=<?php echo $_SESSION['id'];?>">Extension de stockage</a>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<!--<div class = "foot">Copyright &copy Gobo | <a href = "../apropos/?membre=<?php echo $_SESSION['id']?>" class = "lien">a propos</a> </div>-->
		</footer>
	</body>
</html>
<?php
	}
	else{
		header('location:'.$domain);
	}
?>
