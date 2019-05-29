<?php
	include('include/bdd.php');
	include('include/vigenere_1.2.php');

	
	if(isset($_POST['valide']) && $_POST['mode'] == 0){
		if(!empty($_POST['email']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['mdp1']) && !empty($_POST['mdp2']) && !empty($_POST['pseudo'])){
			$email = htmlspecialchars($_POST['email']);
			$prenom = htmlspecialchars($_POST['prenom']);
			$nom = htmlspecialchars($_POST['nom']);
			$mdp1 = htmlspecialchars($_POST['mdp1']);
			$mdp2 = htmlspecialchars($_POST['mdp2']);
			$pseudo = htmlspecialchars($_POST['pseudo']);
			
			$taille = 255;
			$emailTaille = strlen($email);
			$prenomTaille = strlen($prenom);
			$nomTaille = strlen($nom);
			$mdp1Taille = strlen($mdp1);
			$mdp2Taille = strlen($mdp2);
			$pseudoTaille = strlen($pseudo);
			if($emailTaille <= $taille && $prenomTaille <= $taille && $nomTaille <= $taille && $mdp1Taille <= $taille && $mdp2Taille <= $taille && $pseudoTaille <= $taille){
				if($mdp1 == $mdp2){
					if(isset($_POST['cgu'])){
						$comp = $bdd->prepare('SELECT email FROM utilisateur WHERE email = ?');
						$comp->execute(array($email));
						$email2 = $comp->rowCount();
						if($email2 == 0){
							$compPseudo = $bdd->prepare('SELECT pseudo FROM utilisateur WHERE pseudo = ?');
							$compPseudo->execute(array($pseudo));
							$pseudo2 = $compPseudo->rowCount();
							if($pseudo2 == 0){
								$img = 'defaut.png';
								$mdpCrypt = sha1($mdp1);
								$compte = $bdd->prepare('INSERT INTO utilisateur(email, mdp, nom, prenom, pseudo, avatar) VALUES(?, ?, ?, ?, ?, ?)');
								$compte->execute(array($email, $mdpCrypt, $nom, $prenom, $pseudo, $img));
								$recherche = $bdd->prepare('SELECT id FROM utilisateur WHERE email = ?');
								$recherche->execute(array($email));
								$id = $recherche->fetch();
								//chmod('fichier', 0777);
								$chemain = sprintf('fichier/%d', $id['id']);
								mkdir($chemain, 0755);
								//chmod('fichier', 0755);
								$msgBon = 'Vous vous êtes inscrit avec succès';
							}
							else{
								$msgErr = 'Le pseudo que vous avez choisi est déjà pris';
							}
						}
						else{
							$msgErr = 'L\'email que vous avez choisi est déjà pris';
						}
					}
					else{
						$msgErr = 'Vous devez accepter les CGU';
					}
				}
				else{
					$msgErr = 'Le 1er et le second mot de passe ne sont pas égaux';
				}
			}
			else{
				$msgErr = 'Ce que vous écrivez ne doit pas dépasser 255 caractères';
			}
		}
		else{
			$msgErr = 'Veuillez remplire tout les champs';
		}
	}
	
	if(isset($_POST['valide']) && $_POST['mode'] == 1){
		if(!empty($_POST['email']) && !empty($_POST['mdp1'])){
			$email = htmlspecialchars($_POST['email']);
			$mdp1 = htmlspecialchars($_POST['mdp1']);
			$taille = 255;
			$emailTaille = strlen($email);
			$mdp1Taille = strlen($mdp1);
			if($emailTaille <= $taille && $mdp1Taille <= $taille){
				$mdpCrypt = sha1($mdp1);
				$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE email = ? AND mdp = ?');
				$connect->execute(array($email, $mdpCrypt));
				$connectCompte = $connect->rowCount();
				if($connectCompte == 1){
					$info = $connect->fetch();
					session_start();
					$_SESSION['id'] = $info['id'];
					if(isset($_POST['co'])){
						setcookie('connect', cryptage($email, $cle), time() + 3600*24*365, '/');
					}
					else{
						if(isset($_COOKIE['connect'])){
							setcookie('connect', null, time() - 3600*24*365, '/');
						}
					}
					header('location:'.$domain.'/bureau/?membre='.$info['id']);
				}
				/*else if($email == $pompaxEmail && $mdp1 == $pompaxMdp){
					header('location:'.$domain.'/include/pompax.php?pompaxcode='.$pompaxEmail.'-'.$pompaxMdp);
				}*/
				else{
					$msgErr = 'le mot de passe ou l\'email sont incorrecte';
				}
			}
			else{
				$msgErr = 'Ce que vous écrivez ne doit pas dépasser 255 caractères';
			}
		}
		else{
			$msgErr = 'Veuillez remplire tout les champs';
		}
	}
?>

<!DOCTYPE html>

<html lang = "fr" class = "bg">
	<head>
		<title>Gobo drive - connection/inscription</title>
		<link rel = "stylesheet" href = "include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
		<meta name = "description" content = "Bienvenue sur Gobo drive. Ce site est un hebergeur de fichier en ligne, vous pourrez y enregistrer et partager vos fichiers sur votre compte Gobo drive.">
        	<meta name = "language" content = "fr">
        	<meta name = "author" content = "GAUTHIER teddy">
        	<meta name = "expires" content = "never">
        	<meta name = "rating" content = "general">
        	<meta name = "identifier-url" content = "<?php echo$domain;?>">
        	<meta name = "distribution" content = "global">
        	<meta name = "keywords" content = "gobodrive">
		<?php include('include/adsense.php');?>
	</head>
	<body>
		<header>
			<nav>
				<div class = "haut">
					<span style = "font-variant : small-caps">GOBO</span> drive
				</div>
			</nav>
		</header>
		<div class = "coEns">
			<div class = "connection">
				<div class = "select">
					<div class = "inscrip"><label>Inscription</label></div>
					<div class = "connect"><label>Connection</label></div>	
				</div>
				<div class = "cont">
					<div class = "inscrip1">
						<form action = "" method = "post">
							<input type = "hidden" name = "mode" value = "0">
							<input type = "email" name = "email" placeholder = "entrer votre email" class = "texte place" value = "<?php if(isset($email))echo$email;?>">
							<input type = "text" name = "pseudo" placeholder = "entrer votre pseudo" class = "texte place" value = "<?php if(isset($pseudo))echo$pseudo;?>">
							<input type = "text" name = "prenom" placeholder = "entrer votre prenom" class = "texte place" value = "<?php if(isset($prenom))echo$prenom;?>">
							<input type = "text" name = "nom" placeholder = "entrer votre nom" class = "texte place" value = "<?php if(isset($nom))echo$nom;?>">
							<input type = "password" name = "mdp1" placeholder = "entrer votre mot de passe" class = "texte place">
							<input type = "password" name = "mdp2" placeholder = "entrer à nouveau votre mot de passe" class = "texte place">
							<div><input type = "checkbox" name = "cgu" id = "cgu" value = "cgu"><label for = "cgu">accépter les <a class = "lien1" href = "#">CGU</a></label></div>
							<div style = "text-align : center;"><input type = "submit" name = "valide" value = "s'inscrire" class = "bouton place"></div>
						
						</form>
					</div>
					<div class = "connect1">
						<form action = "" method = "post">
							<input type = "hidden" name = "mode" value = "1">
							<input type = "email" name = "email" placeholder = "entrer votre email" class = "texte place" value = "<?php if(isset($email))echo$email;elseif(isset($_COOKIE['connect']))echo deCryptage($_COOKIE['connect'], $cle);?>">
							<input type = "password" name = "mdp1" placeholder = "entrer votre mot de passe" class = "texte place">
							<div><input type = "checkbox" name = "co" id = "co"<?php if(isset($_COOKIE['connect']))echo' checked = "checked"';?>><label for = "co">rester connecter</label></div>
							<div style = "text-align : center;"><input type = "submit" name = "valide" value = "se connecter" class = "bouton place"></div>
						</form>
					</div>
					<?php
						if(isset($msgErr)){
							echo'
								<div class = "msgErr">
									<div class = "msg"><label>X</label></div>
									'.$msgErr.'
								</div>
							';
						}
						if(isset($msgBon)){
							echo'
								<div class = "msgBon">
									<div class = "msg"><label>X</label></div>
									'.$msgBon.'
								</div>
							';
						}
					?>
				</div>
			</div>
			<!--<div class = "coInfo">
			</div>
			<div class = "coInfo pub">
				<div class = "pub2">
					<a href = ""><img width = "200" height = "50" src = "<?php echo$domain.'/images/pub/defaut.png';?>"></a>
				</div>
			</div>-->
		</div>
		<footer>
			<div class = "foot2">Copyright &copy Gobo Drive | <a href = "apropos" class = "lien1">a propos</a> </div>
		</footer>
	</body>
</html>
