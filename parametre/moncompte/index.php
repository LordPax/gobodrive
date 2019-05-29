<?php
	include('../../include/bdd.php');
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
		include('../../include/visite.php');
		
		if(isset($_POST['nom']) && !empty($_POST['nom']) && $_POST['nom'] != $info['nom']){
			$nom = htmlspecialchars($_POST['nom']);
			$change = $bdd->prepare('UPDATE utilisateur SET nom = ? WHERE id = ?');
			$change->execute(array($nom, $_SESSION['id']));
			$msgBonNom = 'votre nom à bien été changé';
		}
		
		if(isset($_POST['prenom']) && !empty($_POST['prenom']) && $_POST['prenom'] != $info['prenom']){
			$prenom = htmlspecialchars($_POST['prenom']);
			$change = $bdd->prepare('UPDATE utilisateur SET prenom = ? WHERE id = ?');
			$change->execute(array($prenom, $_SESSION['id']));
			$msgBonPre = 'votre prénom à bien été changé';
		}
		
		if(isset($_POST['email']) && !empty($_POST['email']) && $_POST['email'] != $info['email']){
			$email = htmlspecialchars($_POST['email']);
			$test = $bdd->prepare('SELECT email FROM utilisateur WHERE email = ?');
			$test->execute(array($email));
			$num = $test->rowCount();
			if($num == 0){
				$change = $bdd->prepare('UPDATE utilisateur SET email = ? WHERE id = ?');
				$change->execute(array($email, $_SESSION['id']));
				$msgBonEmail = 'votre email à bien été changé';
			}
			else{
				$msgErrEmail = 'l\'email que vous venez d\'entré existe déjà';
			}
		}
		
		if(isset($_POST['pseudo']) && !empty($_POST['pseudo']) && $_POST['pseudo'] != $info['pseudo']){
			$pseudo = htmlspecialchars($_POST['pseudo']);
			$testPseudo = $bdd->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = ?');
			$testPseudo->execute(array($pseudo));
			$numPseudo = $testPseudo->rowCount();
			if($numPseudo == 0){
				$change = $bdd->prepare('UPDATE utilisateur SET pseudo = ? WHERE id = ?');
				$change->execute(array($pseudo, $_SESSION['id']));
				$msgBonPseudo = 'votre email à bien été changé';
			}
			else{
				$msgErrPseudo = 'le pseudo que vous venez d\'entré existe déjà';
			}
		}
		
		if(isset($_POST['ancien_mdp']) && isset($_POST['nouv_mdp']) && !empty($_POST['ancien_mdp']) && !empty($_POST['nouv_mdp'])){
			$ancien_mdp = sha1(htmlspecialchars($_POST['ancien_mdp']));
			$nouv_mdp = sha1(htmlspecialchars($_POST['nouv_mdp']));
			if($ancien_mdp == $info['mdp']){
				$change = $bdd->prepare('UPDATE utilisateur SET mdp = ? WHERE id = ?');
				$change->execute(array($nouv_mdp, $_SESSION['id']));
				$msgBonMdp = 'votre mot de passe à bien été changé';
			}
			else{
				$msgErrMdp = 'l\'ancien mot de passe de correspond pas';
			}
		}
		
		if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
			$tailleMax = 2097152;
			$extentionVal = array('jpg', 'jpeg', 'gif', 'png');
			if($_FILES['avatar']['size'] <= $tailleMax){
				$extentionUp = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
				if(in_array($extentionUp, $extentionVal)){
					$chemain = '../../images/imgAvatar/'.$_SESSION['id'].'.'.$extentionUp;
					$resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemain);
					if($resultat){
						$avatar = $bdd->prepare('UPDATE utilisateur SET avatar = :avatar WHERE id = :id');
						$avatar->execute(array(
							'avatar' => $_SESSION['id'].'.'.$extentionUp,
							'id' => $_SESSION['id']
						));
						$msgBonAv = 'votre photo de profil a bien été changé';
					}
					else{
						$msgErrAv = 'Il y a eu une erreur pendant l\'importation de votre photo';
					}
				}
				else{
					$msgErrAv = 'Votre photo de profile doit etre au format jpg, jpeg, gif ou png';
				}
			}
			else{
				$msgErrAv = 'Votre photo de profile ne doit pas dépassé 2Mo';
			}
		}
		
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - mon compte</title>
		<link rel = "stylesheet" href = "../../include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "../../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
		<?php include('include/adsense.php');?>
	</head>
	<body>
		<?php include('../../include/import.php');?>
		<header>
			<nav>
				<div class = "haut">
					<span style = "font-variant : small-caps">GOBO</span> drive
					<img class = "avatar" src = "../../images/imgAvatar/<?php echo $info['avatar'];?>">
				</div>
				<div class = "bas">
					<img src = "../../images/img_par.png" class = "img_par img_par2">.
				</div>
			</nav>
		</header>
		<?php include('../../include/param.php');?>
		<section class = "princip princip_taille">
			<div class = "actu">
				<div class = "fen_param">
					<div class = "titre_param">Mon compte</div>
					<div class = "cont_param">
						<form method = "post" action = "" enctype = "multipart/form-data">
							<?php
								echo'
									<div class = "paire prem_pseudo">pseudo : '.$info['pseudo'].'<span class = "lien1 modif modif_pseudo"><label>modifier</label></span></div>
									<div class = "second_pseudo"><input value = "'.$info['pseudo'].'" type = "text" class = "texte place" style = "width : 90%" name = "pseudo" placeholder = "nouveau pseudo"><span class = "modif annul_pseudo"><label>X</label></span></div>
									
									<div class = "impaire prem_nom">nom : '.$info['nom'].'<span class = "lien1 modif modif_nom"><label>modifier</label></span></div>
									<div class = "second_nom"><input value = "'.$info['nom'].'" type = "text" class = "texte place" style = "width : 90%" name = "nom" placeholder = "nouveau nom"><span class = "modif annul_nom"><label>X</label></span></div>
									
									<div class = "paire prem_prenom">prenom : '.$info['prenom'].'<span class = "lien1 modif modif_prenom"><label>modifier</label></span></div>
									<div class = "second_prenom"><input value = "'.$info['prenom'].'" type = "text" class = "texte place" style = "width : 90%" name = "prenom" placeholder = "nouveau prenom"><span class = "modif annul_prenom"><label>X</label></span></div>
									
									<div class = "impaire prem_email">email : '.$info['email'].'<span class = "lien1 modif modif_email"><label>modifier</label></span></div>
									<div class = "second_email"><input value = "'.$info['email'].'" type = "text" class = "texte place" style = "width : 90%" name = "email" placeholder = "nouvel email"><span class = "modif annul_email"><label>X</label></span></div>
									
									<div class = "paire prem_mdp">mot de passe<span class = "lien1 modif modif_mdp"><label>modifier</label></span></div>
									<div class = "second_mdp">
										<input type = "password" class = "texte place" style = "width : 90%" name = "ancien_mdp" placeholder = "ancien mot de passe">
										<input type = "password" class = "texte place" style = "width : 90%" name = "nouv_mdp" placeholder = "nouveau mot de passe">
										<span class = "modif annul_mdp"><label>X</label></span>
									</div>
									
									<div class = "impaire prem_avatar">photo de profil : '.$info['avatar'].'<span class = "lien1 modif modif_avatar"><label>modifier</label></span></div>
									<div class = "second_avatar"><input type = "file" class = "place" name = "avatar"><span class = "modif annul_avatar"><label>X</label></span></div>
									
									<div style = "text-align : center;"><input style = "margin-top : 10%" type = "submit" class = "bouton place" value = "modifier" name = "modif" ></div>
								';
							?>
						</form>
						<?php
							if(isset($msgErrMdp)){
								echo'
									<div class = "msgErr">
										<div class = "msg"><label>X</label></div>
										'.$msgErrMdp.'
									</div>
								';
							}
							if(isset($msgErrEmail)){
								echo'
									<div class = "msgErr">
										<div class = "msg"><label>X</label></div>
										'.$msgErrEmail.'
									</div>
								';
							}
							if(isset($msgErrAv)){
								echo'
									<div class = "msgErr">
										<div class = "msg"><label>X</label></div>
										'.$msgErrAv.'
									</div>
								';
							}
							if(isset($msgBonNom)){
								echo'
									<div class = "msgBon">
										<div class = "msg"><label>X</label></div>
										'.$msgBonNom.'
									</div>
								';
							}
							if(isset($msgBonPre)){
								echo'
									<div class = "msgBon">
										<div class = "msg"><label>X</label></div>
										'.$msgBonPre.'
									</div>
								';
							}
							if(isset($msgBonEmail)){
								echo'
									<div class = "msgBon">
										<div class = "msg"><label>X</label></div>
										'.$msgBonEmail.'
									</div>
								';
							}
							if(isset($msgBonMdp)){
								echo'
									<div class = "msgBon">
										<div class = "msg"><label>X</label></div>
										'.$msgBonMdp.'
									</div>
								';
							}
							if(isset($msgBonAv)){
								echo'
									<div class = "msgBon">
										<div class = "msg"><label>X</label></div>
										'.$msgBonAv.'
									</div>
								';
							}
						?>
					</div>
				</div>
			</div>
		</section>
		<footer>
			<!--<div class = "foot">Copyright &copy Gobo | <a href = "../../apropos/?membre=<?php echo $_SESSION['id']?>" class = "lien">a propos</a> </div>-->
		</footer>
	</body>
</html>
<?php
	}
	else{
		header('location:'.$domain);
	}
?>
