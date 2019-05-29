<?php
	include('../include/bdd.php');
	//session_start();
	$id = htmlspecialchars($_GET['id']);
	$partage = $bdd->prepare('SELECT * FROM fichier WHERE id = ?');
	$partage->execute(array($id));
	$verif = $partage->rowCount();
	$infoPartage = $partage->fetch();

	$proprio = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
	$proprio->execute(array($infoPartage['lien_id']));
	$infoProprio = $proprio->fetch();
	
	$telecharge = $bdd->prepare('SELECT * FROM telecharge WHERE lien_fichier = ?');
	$telecharge->execute(array($id));
	$nbTele = $telecharge->rowCount();
	
	$ext = substr(strrchr($infoPartage['nom'], '.'), 1);
	
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
	}
	
	//include('../include/visite.php');
	//include('../include/import2.php');
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - <?php echo$infoPartage['nom'];?></title>
		<link rel = "stylesheet" href = "../include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
	</head>
	<body>
		<?php
			if($verif != 0){
				if($ext == $pdf_ext){
					if(isset($info['id']) && $infoPartage['lien_id'] == $info['id']){
						echo'<iframe class = "video" src = "'.$domain.'/fichier/'.$infoPartage['lien_id'].'/'.$infoPartage['nom'].'" frameborder = "0"></iframe>';
					}
					else if($infoPartage['partage'] == 1){
						//echo'<video class = "video" src = "'.$domain.'/fichier/'.$infoPartage['lien_id'].'/'.$infoPartage['nom'].'" controls></video>';
						echo'<iframe class = "video" src = "'.$domain.'/fichier/'.$infoPartage['lien_id'].'/'.$infoPartage['nom'].'" frameborder = "0"></iframe>';
					}
					else{
						echo'Vous n\'avez pas l\'autorisation de consulter se fichier';
					}
				}
				else{
					echo'Ce fichier n\'est pas un fichier pdf';
				}
			}
			else{
				echo'Le fichier n\'existe pas ou a été suppimer';
			}
		?>
	</body>
</html>
