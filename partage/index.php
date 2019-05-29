<?php
	include('../include/bdd.php');
	//session_start();
	$id = htmlspecialchars($_GET['id']);
	$partage = $bdd->prepare('SELECT * FROM fichier WHERE id = ?');
	$partage->execute(array($id));
	$verif = $partage->rowCount();
	if(isset($_GET['id']) && !empty($_GET['id']) && $verif == 1){
		$infoPartage = $partage->fetch();
	
		$proprio = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$proprio->execute(array($infoPartage['lien_id']));
		$infoProprio = $proprio->fetch();
		
		$telecharge = $bdd->prepare('SELECT * FROM telecharge WHERE lien_fichier = ?');
		$telecharge->execute(array($id));
		$nbTele = $telecharge->rowCount();
		
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
		<?php include('include/adsense.php');?>
	</head>
	<body>
		<header>
			<nav>
				<div class = "haut">
					<a class = "lienTitre" href = "<?php echo $domain;?>"><span style = "font-variant : small-caps">GOBO</span> drive</a>
				</div>
			</nav>
		</header>
		<section class = "princip page_partage">
			<div class = "actu">
				<?php
					echo'<div class = "cont_apercu">
						<div class = "titre_partage">partage</div>
						';
						$ext = substr(strrchr($infoPartage['nom'], '.'), 1);
						if(in_array($ext, $img_ext)){
							if($infoPartage['partage'] == 1){
								echo'<img class = "img_apercu" src = "'.$domain.'/fichier/'.$infoPartage['lien_id'].'/'.$infoPartage['nom'].'">';
							}
							else{
								echo'
									<div class = "msgErr">
										<div class = "msg"><label>X</label></div>
										Vous n\'avez pas l\'autorisation de consulter cette image
									</div>
								';
							}
						}
						elseif(in_array($ext, $vid_ext)){
							echo'<iframe src = "'.$domain.'/video/?id='.$infoPartage['id'].'" class = "img_apercu" allowfullscreen frameborder = "0"></iframe>';
						
							//echo'<video class = "img_apercu" src = "'.$domain.'/fichier/'.$infoPartage['lien_id'].'/'.$infoPartage['nom'].'" controls></video>';
						}
						elseif(in_array($ext, $sic_ext)){
							echo'<audio class = "img_apercu" src = "'.$domain.'/fichier/'.$infoPartage['lien_id'].'/'.$infoPartage['nom'].'" controls></audio>';
						}
						else if($ext == $pdf_ext){
							/*echo'
								<a class = "lien1" href = "'.$domain.'/pdf/?id='.$infoPartage['id'].'" target = "_Blank">
									<img class = "img_apercu" src = "../images/miniature/imgPdf.png">
									
									Voir le pdf
									
								</a>
							';*/
							echo'
								
								<a style = "float : left" class = "lien1" href = "'.$domain.'/pdf/?id='.$infoPartage['id'].'" target = "_Blank">
									<img class = "img_apercu" src = "../images/miniature/imgPdf.png">
									<div>Voir le pdf</div>
								</a>
								<style>
									.cont_comm{
										height : 250px;
									}
								</style>
							';
						}
						else{
							echo'<img class = "img_apercu" src = "../images/miniature/defaut.png">';
						}
						$tTaille = strlen($infoPartage['taille']);
						if(0 <= $tTaille && $tTaille <= 3){
							$tTaille2 = $infoPartage['taille'].' o';
						}
						else if(4 <= $tTaille && $tTaille <= 6){
							$tTaille2 = substr($infoPartage['taille'], 0, $tTaille - 3).' Ko';
						}
						else if(7 <= $tTaille && $tTaille <= 9){
							$tTaille2 = substr($infoPartage['taille'], 0, $tTaille - 6).' Mo';
						}
						else if(10 <= $tTaille){
							$tTaille2 = substr($infoPartage['taille'], 0, $tTaille - 9).' Go';
						}
						echo'
						<div class = "descrip_partage">
							<div class = "descrip_ligne">nom<div class = "descrip_ligne2">'.$infoPartage['nom'].'</div></div>
							<div class = "descrip_ligne">taille<div class = "descrip_ligne2">'.$tTaille2.'</div></div>
							<div class = "descrip_ligne">propriétaire<div class = "descrip_ligne2">'.$infoProprio['pseudo'].'</div></div>
							<div class = "descrip_ligne">téléchargement<div class = "descrip_ligne2">'.$nbTele.'</div></div>
							<div class = "descrip_ligne_tele"><a href = "';if($infoPartage['partage'] == 1 )echo'../include/telecharger2.php?id='.$infoPartage['id'];echo'"><button class = "telechargement'; 	
							if($infoPartage['partage'] == 1) echo' on';else echo' off';echo'">téléchargement</button></a></div>
						</div>
					</div>';
				?>
			</div>
		</section>
		<footer>
			<div class = "foot">Copyright &copy Gobo | <a href = "../apropos" class = "lien">a propos</a> </div>
		</footer>
	</body>
</html>
<?php
	}
	else{
		header('location:'.$domain);
	}
?>
