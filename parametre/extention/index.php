<?php
	include('../../include/bdd.php');
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
				<div class = "">
					<div class = "titre_param">Extention de stockage</div>
					<div class = "cont_param">
						<div class = "payement">
							<div class = "pay1">
								<div class = "titre_param pack1">Pack standard</div>
								<div>
									<form method = "post" action = "">
										<input type = "submit" value = "passer standard" class = "bouton2">
									</form>
								</div>
							</div>
							<div class = "pay2">
								<div class = "titre_param pack2">Pack VIP</div>
								<div>
									<form method = "post" action = "">
										<input type = "submit" value = "passer VIP" class = "bouton">
									</form>
								</div>
							</div>
							<div class = "pay3">
								<div class = "titre_param pack3">Pack prémium</div>
								<div>
									<form method = "post" action = "">
										<input type = "submit" value = "passer prémium" class = "bouton2">
									</form>
								</div>
							</div>
						</div>
						<!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_xclick-subscriptions">
							<input type="hidden" name="business" value="superted.TG@gmail.com">
							<input type="hidden" name="lc" value="FR">
							<input type="hidden" name="item_name" value="abonnement">
							<input type="hidden" name="no_note" value="1">
							<input type="hidden" name="src" value="1">
							<input type="hidden" name="currency_code" value="EUR">
							<input type="hidden" name="bn" value="PP-SubscriptionsBF:btn_subscribe_LG.gif:NonHostedGuest">
							<table>
								<tr>
									<td><input type="hidden" name="on0" value="abonnement">abonnement</td>
								</tr>
								<tr>
									<td>
										<select name="os0">
											<option value="pack 1">pack 1 : €10,00 EUR - mensuel</option>
											<option value="pack 2">pack 2 : €20,00 EUR - mensuel</option>
										</select>
									</td>
								</tr>
							</table>
							<input type="hidden" name="currency_code" value="EUR">
							<input type="hidden" name="option_select0" value="pack 1">
							<input type="hidden" name="option_amount0" value="10.00">
							<input type="hidden" name="option_period0" value="M">
							<input type="hidden" name="option_frequency0" value="1">
							<input type="hidden" name="option_select1" value="pack 2">
							<input type="hidden" name="option_amount1" value="20.00">
							<input type="hidden" name="option_period1" value="M">
							<input type="hidden" name="option_frequency1" value="1">
							<input type="hidden" name="option_index" value="0">
							<input type="image" src="https://www.sandbox.paypal.com/fr_FR/FR/i/btn/btn_subscribe_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
							<img alt="" border="0" src="https://www.sandbox.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
							
						</form>-->
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
