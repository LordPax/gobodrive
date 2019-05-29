<?php
	include('../include/bdd.php');
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
		include('../include/visite.php');
		include('../include/import2.php');
		include('../include/renome2.php');
		include('../include/suppre2.php');
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - bureau</title>
		<link rel = "stylesheet" href = "../include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
		<?php include('../include/adsense.php');?>
	</head>
	<body>
		<?php include('../include/import.php');?>
		<?php //phpinfo();include('../include/autorisation.php');?>
		<div class = "apercu_ici"></div>
		<div class = "partage_ici"></div>
		<div class = "renome_ici"></div>
		<div class = "suppre_ici"></div>
		<header>
			<nav>
				<div class = "haut">
					<span style = "font-variant : small-caps">GOBO</span> drive
					<img class = "avatar" src = "../images/imgAvatar/<?php echo $info['avatar'];?>">
				</div>
				<div class = "bas">
					<img src = "../images/img_par.png" class = "img_par img_par2">
					<div class = "import"><label>importer</label></div>
				</div>
			</nav>
		</header>
		<?php include('../include/param.php');?>
		<section class = "princip princip_taille">
			<div class = "actu">
				<?php
					if(isset($msgErrDoc)){
						echo'
							<div class = "msgErr">
								<div class = "msg"><label>X</label></div>
								'.$msgErrDoc.'
							</div>
						';
					}
					if(isset($msgBonDoc)){
						echo'
							<div class = "msgBon">
								<div class = "msg"><label>X</label></div>
								'.$msgBonDoc.'
							</div>
						';
					}
				
					$boucle = 1;
					$fichier = $bdd->prepare('SELECT * FROM fichier WHERE lien_id = ? ORDER BY nom');
					$fichier->execute(array($_SESSION['id']));
					while($donnees = $fichier->fetch()){
						$ext = substr(strrchr($donnees['nom'], '.'), 1);
						$nom = explode('.', $donnees['nom']);
						if(in_array($ext, $img_ext)){
							$chemin = '../fichier/'.$_SESSION['id'].'/'.$donnees['nom'];
						}
						elseif(in_array($ext, $vid_ext)){
							$chemin = '../images/miniature/imgVid.png';
						}
						elseif(in_array($ext, $sic_ext)){
							$chemin = '../images/miniature/imgSic.png';
						}
						elseif($ext == $pdf_ext){
							$chemin = '../images/miniature/imgPdf.png';
						}
						else{
							$chemin = '../images/miniature/defaut.png';
						}
						$tailleMax = 10;
						$nomCoup = substr($nom[0], 0, $tailleMax);
						$petitNom = $nomCoup.'.'.$ext;
						echo'
							<div class = "fichier fic'.$boucle.'">
								<div>
									<img class = "img_fic" src = "'.$chemin.'">
									<div class = "nom_fic">'.$petitNom.'</div>
								</div>
								<div class = "fic_detail fic_d'.$boucle.'">
									<div class = "detail apercu_d"><label for = "apercu_sub'.$boucle.'">aperçu</label></div>
									<div class = "detail tele_d"><label><a class = "telecharge" href = "../include/telecharger.php?id='.$donnees['id'].'&membre='.$_SESSION['id'].'">télécharger</a></label></div>
									<div class = "detail partage_d"><label for = "partage_sub'.$boucle.'">partager</label></div>
									<div class = "detail renom_d"><label for = "renome_sub'.$boucle.'">renommer</label></div>
									<div class = "detail suppre_d"><label for = "suppre_sub'.$boucle.'">supprimer</label></div>
								</div>
								<form class = "apercu_form'.$boucle.'" action = "" method = "post">
									<input type = "hidden" id = "id'.$boucle.'" value = "'.$donnees['id'].'">
									<input type = "hidden" id = "membre'.$boucle.'" value = "'.$_SESSION['id'].'">
									<input type = "submit" id = "apercu_sub'.$boucle.'" style = "display : none;">
								</form>
								<form class = "partage_form'.$boucle.'" action = "" method = "post">
									<input type = "hidden" id = "partage_id'.$boucle.'" value = "'.$donnees['id'].'">
									<input type = "hidden" id = "partage_membre'.$boucle.'" value = "'.$_SESSION['id'].'">
									<input type = "submit" id = "partage_sub'.$boucle.'" style = "display : none;">
								</form>
								<form class = "renome_form'.$boucle.'" action = "" method = "post">
									<input type = "hidden" id = "renome_id'.$boucle.'" value = "'.$donnees['id'].'">
									<input type = "hidden" id = "renome_membre'.$boucle.'" value = "'.$_SESSION['id'].'">
									<input type = "submit" id = "renome_sub'.$boucle.'" style = "display : none;">
								</form>
								<form class = "suppre_form'.$boucle.'" action = "" method = "post">
									<input type = "hidden" id = "suppre_id'.$boucle.'" value = "'.$donnees['id'].'">
									<input type = "hidden" id = "suppre_membre'.$boucle.'" value = "'.$_SESSION['id'].'">
									<input type = "submit" id = "suppre_sub'.$boucle.'" style = "display : none;">
								</form>
								<script>
									$(\'.fic_d'.$boucle.'\').hide();
									$(\'.fic'.$boucle.'\').mouseover(function(){
										$(\'.fic_d'.$boucle.'\').stop().fadeIn(200);
									});

									$(\'.fic'.$boucle.'\').mouseout(function(){
										$(\'.fic_d'.$boucle.'\').stop().fadeOut(200);
									});
									
									$(\'.apercu_form'.$boucle.'\').submit(function(){
										id = $(\'#id'.$boucle.'\').val();
										membre = $(\'#membre'.$boucle.'\').val();
										$.post(\'../include/apercu.php\', {
											id : id,
											membre : membre
										}, function(donnees){
											$(\'.apercu_ici\').html(donnees);
											$(\'.fermer_apercu_d\').click(function(){
												$(\'.apercu\').hide();
											});
										});
										return false;
									});
									$(\'.partage_form'.$boucle.'\').submit(function(){
										partage_id = $(\'#partage_id'.$boucle.'\').val();
										partage_membre = $(\'#partage_membre'.$boucle.'\').val();
										$.post(\'../include/autorisation.php\', {
											id : partage_id,
											membre : partage_membre
										}, function(donnees){
											$(\'.partage_ici\').html(donnees);
											$(\'.fermer_partage\').click(function(){
												$(\'.partage\').hide();
											});
										});
										return false;
									});
									$(\'.renome_form'.$boucle.'\').submit(function(){
										renome_id = $(\'#renome_id'.$boucle.'\').val();
										renome_membre = $(\'#renome_membre'.$boucle.'\').val();
										$.post(\'../include/renome.php\', {
											id : renome_id,
											membre : renome_membre
										}, function(donnees){
											$(\'.renome_ici\').html(donnees);
											$(\'.fermer_renome\').click(function(){
												$(\'.renome\').hide();
											});
										});
										return false;
									});
									$(\'.suppre_form'.$boucle.'\').submit(function(){
										suppre_id = $(\'#suppre_id'.$boucle.'\').val();
										suppre_membre = $(\'#suppre_membre'.$boucle.'\').val();
										$.post(\'../include/suppre.php\', {
											id : suppre_id,
											membre : suppre_membre
										}, function(donnees){
											$(\'.suppre_ici\').html(donnees);
											$(\'.fermer_suppre\').click(function(){
												$(\'.suppre\').hide();
											});
										});
										return false;
									});
								</script>
							</div>
						';
						$boucle++;
					}
				?>
			</div>
		</section>
		<footer>
			<!--<div class = "foot">Copyright &copy Gobo | <a href = "../apropos/?membre=<?php echo $_SESSION['id'];?>" class = "lien">a propos</a> </div>-->
		</footer>
	</body>
</html>
<?php
	}
	else{
		header('location:'.$domain);
	}
?>
