<?php
	include('bdd.php');
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
		include('../../include/visite.php');
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - mon compte</title>
		<link rel = "stylesheet" href = "design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
	</head>
	<body>
		<?php include('import.php');?>
		<header>
			<nav>
				<div class = "haut">
					<span style = "font-variant : small-caps">GOBO</span> drive
					<img class = "avatar" src = "../../images/imgAvatar/<?php echo $info['avatar'];?>">
				</div>
				<div class = "bas">
					<img src = "../../images/img_par.png" class = "img_par img_par2">
					<div class = "import"><label>importer</label></div>
				</div>
			</nav>
		</header>
		<div class = "param">
			<img src = "../../images/img_par_2.png" class = "img_par img_par1">
			<div class = "ens_param">
				<a class = "par" href = "../../bureau/?membre=<?php echo $_SESSION['id'];?>">Bureau</a>
				<a class = "par" href = "../../parametre/?membre=<?php echo $_SESSION['id'];?>">Paramètre</a>
				<a class = "par" href = "deconnection.php">Déconnection</a>
			</div>
		</div>
		<section class = "princip page_param">
			<div class = "actu">
				<div class = "fen_param">
					<div class = "titre_param">Extention de stockage</div>
					<div class = "cont_param">
						bravo
					</div>
				</div>
			</div>
		</section>
		<footer>
			<div class = "foot">Copyright &copy Gobo | <a href = "../../apropos/?membre=<?php echo $_SESSION['id']?>" class = "lien">a propos</a> </div>
		</footer>
	</body>
</html>
<?php
	}
	else{
		header('location:'.$domain);
	}
?>
