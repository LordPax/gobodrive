<?php
	include('../include/bdd.php');
	session_start();
	if(isset($_GET['membre']) && !empty($_GET['membre']) && $_GET['membre'] >= 0 && $_SESSION['id'] == $_GET['membre']){
		$connect = $bdd->prepare('SELECT * FROM utilisateur WHERE id = ?');
		$connect->execute(array($_SESSION['id']));
		$info = $connect->fetch();
		include('../include/visite.php');
		$annees = date('Y');
		$mois = date('m');
		$jours = date('d');
		$echelle = 20;
		
?>

<!DOCTYPE html>

<html lang = "fr">
	<head>
		<title>Gobo drive - statistique</title>
		<link rel = "stylesheet" href = "../include/design.css">
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "../include/jquery_3.1.1.js"></script>
		<script type = "text/javascript" src = "../include/code.js"></script>
		<meta name = "viewport" content = "width=divice-width, initial-scale=1.0">
	</head>
	<body>
		<header>
			<nav>
				<div class = "haut">
					<span style = "font-variant : small-caps">GOBO</span> drive
					<img class = "avatar" src = "../images/imgAvatar/<?php echo $info['avatar'];?>">
				</div>
				<div class = "bas">
					<img src = "../images/img_par.png" class = "img_par img_par2">
					<div class = "test"><label>.</label></div>
				</div>
			</nav>
		</header>
		<?php include('../include/param.php');?>
		<section class = "princip princip_taille">
			<div class = "actu">
				<div class = "fen_param">
					<div class = "titre_param">nombre de membre</div>
					<div class = "cont_param">
						<?php
							$util = $bdd->query('SELECT * FROM utilisateur');
							$user = $util->rowCount();
							echo '<div class = "stat2">'.$user.'</div>';
						?>
						
					</div>
				</div>
				<div class = "fen_param">
					<div class = "titre_param">nombre de visite total</div>
					<div class = "cont_param">
						<?php
							$visiteT = $bdd->query('SELECT * FROM visite');
							$nbVisiteT = $visiteT->rowCount();
							echo '<div class = "stat2">'.$nbVisiteT.'</div>';
						?>
						
					</div>
				</div>
				<div class = "fen_param">
					<div class = "titre_param">nombre de visite par jour</div>
					<div class = "cont_param">
						<?php							
							$visiteJ = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
							$visiteJ->execute(array($annees, $mois, $jours));
							$nbVisiteJ = $visiteJ->rowCount();
							echo '<div class = "stat2">'.$nbVisiteJ.'</div>';
						?>
						
					</div>
				</div>
				<div class = "fen_param">
					<div class = "titre_param">nombre de visite par mois</div>
					<div class = "cont_param">
						<?php
							$visiteM = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ?');
							$visiteM->execute(array($annees, $mois));
							$nbVisiteM = $visiteM->rowCount();
							echo '<div class = "stat2">'.$nbVisiteM.'</div>';
						?>
						
					</div>
				</div>
				
				<div class = "fen_param">
					<div class = "titre_param">nombre de visite par jours sur un mois</div>
					<div class = "cont_param graphScroll">
						<?php
							//echo'annee : '.$annees.'</br>mois : '.$mois;
							echo $jours.' / '.$mois.' / '.$annees;
						?>
						<div style = "width : 1500px;">
							<br/>
							<?php
								echo'<table width = "100%" class = "graph">
									<tr>
										<td class = "graph graph3">
											<div class = "posEchelle">'.$echelle.'</div>
											<div class = "posEchelle2">'.$echelle / 2 .'</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph1 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph1->execute(array($annees, $mois, 1));
											$graphVisiteNb1 = $graph1->rowCount();
											$graphVisitePour1 = ($graphVisiteNb1 * 100) / $echelle;
											$graphCompen1 = 100 - $graphVisitePour1;
											echo'
											<style>
												.grapBarreAv1{
													height : '.$graphVisitePour1.'%;
													position : relative;
													top : '.$graphCompen1.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv1">
													<div class = "nb">
														'.$graphVisiteNb1.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph2 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph2->execute(array($annees, $mois, 2));
											$graphVisiteNb2 = $graph2->rowCount();
											$graphVisitePour2 = ($graphVisiteNb2 * 100) / $echelle;
											$graphCompen2 = 100 - $graphVisitePour2;
											echo'
											<style>
												.grapBarreAv2{
													height : '.$graphVisitePour2.'%;
													position : relative;
													top : '.$graphCompen2.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv2">
													<div class = "nb">
														'.$graphVisiteNb2.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph3 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph3->execute(array($annees, $mois, 3));
											$graphVisiteNb3 = $graph3->rowCount();
											$graphVisitePour3 = ($graphVisiteNb3 * 100) / $echelle;
											$graphCompen3 = 100 - $graphVisitePour3;
											echo'
											<style>
												.grapBarreAv3{
													height : '.$graphVisitePour3.'%;
													position : relative;
													top : '.$graphCompen3.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv3">
													<div class = "nb">
														'.$graphVisiteNb3.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph4 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph4->execute(array($annees, $mois, 4));
											$graphVisiteNb4 = $graph4->rowCount();
											$graphVisitePour4 = ($graphVisiteNb4 * 100) / $echelle;
											$graphCompen4 = 100 - $graphVisitePour4;
											echo'
											<style>
												.grapBarreAv4{
													height : '.$graphVisitePour4.'%;
													position : relative;
													top : '.$graphCompen4.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv4">
													<div class = "nb">
														'.$graphVisiteNb4.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph5 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph5->execute(array($annees, $mois, 5));
											$graphVisiteNb5 = $graph5->rowCount();
											$graphVisitePour5 = ($graphVisiteNb5 * 100) / $echelle;
											$graphCompen5 = 100 - $graphVisitePour5;
											echo'
											<style>
												.grapBarreAv5{
													height : '.$graphVisitePour5.'%;
													position : relative;
													top : '.$graphCompen5.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv5">
													<div class = "nb">
														'.$graphVisiteNb5.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph6 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph6->execute(array($annees, $mois, 6));
											$graphVisiteNb6 = $graph6->rowCount();
											$graphVisitePour6 = ($graphVisiteNb6 * 100) / $echelle;
											$graphCompen6 = 100 - $graphVisitePour6;
											echo'
											<style>
												.grapBarreAv6{
													height : '.$graphVisitePour6.'%;
													position : relative;
													top : '.$graphCompen6.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv6">
													<div class = "nb">
														'.$graphVisiteNb6.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph7 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph7->execute(array($annees, $mois, 7));
											$graphVisiteNb7 = $graph7->rowCount();
											$graphVisitePour7 = ($graphVisiteNb7 * 100) / $echelle;
											$graphCompen7 = 100 - $graphVisitePour7;
											echo'
											<style>
												.grapBarreAv7{
													height : '.$graphVisitePour7.'%;
													position : relative;
													top : '.$graphCompen7.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv7">
													<div class = "nb">
														'.$graphVisiteNb7.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph8 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph8->execute(array($annees, $mois, 8));
											$graphVisiteNb8 = $graph8->rowCount();
											$graphVisitePour8 = ($graphVisiteNb8 * 100) / $echelle;
											$graphCompen8 = 100 - $graphVisitePour8;
											echo'
											<style>
												.grapBarreAv8{
													height : '.$graphVisitePour8.'%;
													position : relative;
													top : '.$graphCompen8.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv8">
													<div class = "nb">
														'.$graphVisiteNb8.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph9 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph9->execute(array($annees, $mois, 9));
											$graphVisiteNb9 = $graph9->rowCount();
											$graphVisitePour9 = ($graphVisiteNb9 * 100) / $echelle;
											$graphCompen9 = 100 - $graphVisitePour9;
											echo'
											<style>
												.grapBarreAv9{
													height : '.$graphVisitePour9.'%;
													position : relative;
													top : '.$graphCompen9.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv9">
													<div class = "nb">
														'.$graphVisiteNb9.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph10 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph10->execute(array($annees, $mois, 10));
											$graphVisiteNb10 = $graph10->rowCount();
											$graphVisitePour10 = ($graphVisiteNb10 * 100) / $echelle;
											$graphCompen10 = 100 - $graphVisitePour10;
											echo'
											<style>
												.grapBarreAv10{
													height : '.$graphVisitePour10.'%;
													position : relative;
													top : '.$graphCompen10.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv10">
													<div class = "nb">
														'.$graphVisiteNb10.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph11 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph11->execute(array($annees, $mois, 11));
											$graphVisiteNb11 = $graph11->rowCount();
											$graphVisitePour11 = ($graphVisiteNb11 * 100) / $echelle;
											$graphCompen11 = 100 - $graphVisitePour11;
											echo'
											<style>
												.grapBarreAv11{
													height : '.$graphVisitePour11.'%;
													position : relative;
													top : '.$graphCompen11.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv11">
													<div class = "nb">
														'.$graphVisiteNb11.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph12 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph12->execute(array($annees, $mois, 12));
											$graphVisiteNb12 = $graph12->rowCount();
											$graphVisitePour12 = ($graphVisiteNb12 * 100) / $echelle;
											$graphCompen12 = 100 - $graphVisitePour12;
											echo'
											<style>
												.grapBarreAv12{
													height : '.$graphVisitePour12.'%;
													position : relative;
													top : '.$graphCompen12.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv12">
													<div class = "nb">
														'.$graphVisiteNb12.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph13 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph13->execute(array($annees, $mois, 13));
											$graphVisiteNb13 = $graph13->rowCount();
											$graphVisitePour13 = ($graphVisiteNb13 * 100) / $echelle;
											$graphCompen13 = 100 - $graphVisitePour13;
											echo'
											<style>
												.grapBarreAv13{
													height : '.$graphVisitePour13.'%;
													position : relative;
													top : '.$graphCompen13.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv13">
													<div class = "nb">
														'.$graphVisiteNb13.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph14 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph14->execute(array($annees, $mois, 14));
											$graphVisiteNb14 = $graph14->rowCount();
											$graphVisitePour14 = ($graphVisiteNb14 * 100) / $echelle;
											$graphCompen14 = 100 - $graphVisitePour14;
											echo'
											<style>
												.grapBarreAv14{
													height : '.$graphVisitePour14.'%;
													position : relative;
													top : '.$graphCompen14.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv14">
													<div class = "nb">
														'.$graphVisiteNb14.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph15 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph15->execute(array($annees, $mois, 15));
											$graphVisiteNb15 = $graph15->rowCount();
											$graphVisitePour15 = ($graphVisiteNb15 * 100) / $echelle;
											$graphCompen15 = 100 - $graphVisitePour15;
											echo'
											<style>
												.grapBarreAv15{
													height : '.$graphVisitePour15.'%;
													position : relative;
													top : '.$graphCompen15.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv15">
													<div class = "nb">
														'.$graphVisiteNb15.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph16 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph16->execute(array($annees, $mois, 16));
											$graphVisiteNb16 = $graph16->rowCount();
											$graphVisitePour16 = ($graphVisiteNb16 * 100) / $echelle;
											$graphCompen16 = 100 - $graphVisitePour16;
											echo'
											<style>
												.grapBarreAv16{
													height : '.$graphVisitePour16.'%;
													position : relative;
													top : '.$graphCompen16.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv16">
													<div class = "nb">
														'.$graphVisiteNb16.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph17 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph17->execute(array($annees, $mois, 17));
											$graphVisiteNb17 = $graph17->rowCount();
											$graphVisitePour17 = ($graphVisiteNb17 * 100) / $echelle;
											$graphCompen17 = 100 - $graphVisitePour17;
											echo'
											<style>
												.grapBarreAv17{
													height : '.$graphVisitePour17.'%;
													position : relative;
													top : '.$graphCompen17.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv17">
													<div class = "nb">
														'.$graphVisiteNb17.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph18 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph18->execute(array($annees, $mois, 18));
											$graphVisiteNb18 = $graph18->rowCount();
											$graphVisitePour18 = ($graphVisiteNb18 * 100) / $echelle;
											$graphCompen18 = 100 - $graphVisitePour18;
											echo'
											<style>
												.grapBarreAv18{
													height : '.$graphVisitePour18.'%;
													position : relative;
													top : '.$graphCompen18.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv18">
													<div class = "nb">
														'.$graphVisiteNb18.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph19 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph19->execute(array($annees, $mois, 19));
											$graphVisiteNb19 = $graph19->rowCount();
											$graphVisitePour19 = ($graphVisiteNb19 * 100) / $echelle;
											$graphCompen19 = 100 - $graphVisitePour19;
											echo'
											<style>
												.grapBarreAv19{
													height : '.$graphVisitePour19.'%;
													position : relative;
													top : '.$graphCompen19.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv19">
													<div class = "nb">
														'.$graphVisiteNb19.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph20 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph20->execute(array($annees, $mois, 20));
											$graphVisiteNb20 = $graph20->rowCount();
											$graphVisitePour20 = ($graphVisiteNb20 * 100) / $echelle;
											$graphCompen20 = 100 - $graphVisitePour20;
											echo'
											<style>
												.grapBarreAv20{
													height : '.$graphVisitePour20.'%;
													position : relative;
													top : '.$graphCompen20.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv20">
													<div class = "nb">
														'.$graphVisiteNb20.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph21 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph21->execute(array($annees, $mois, 21));
											$graphVisiteNb21 = $graph21->rowCount();
											$graphVisitePour21 = ($graphVisiteNb21 * 100) / $echelle;
											$graphCompen21 = 100 - $graphVisitePour21;
											echo'
											<style>
												.grapBarreAv21{
													height : '.$graphVisitePour21.'%;
													position : relative;
													top : '.$graphCompen21.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv21">
													<div class = "nb">
														'.$graphVisiteNb21.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph22 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph22->execute(array($annees, $mois, 22));
											$graphVisiteNb22 = $graph22->rowCount();
											$graphVisitePour22 = ($graphVisiteNb22 * 100) / $echelle;
											$graphCompen22 = 100 - $graphVisitePour22;
											echo'
											<style>
												.grapBarreAv22{
													height : '.$graphVisitePour22.'%;
													position : relative;
													top : '.$graphCompen22.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv22">
													<div class = "nb">
														'.$graphVisiteNb22.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph23 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph23->execute(array($annees, $mois, 23));
											$graphVisiteNb23 = $graph23->rowCount();
											$graphVisitePour23 = ($graphVisiteNb23 * 100) / $echelle;
											$graphCompen23 = 100 - $graphVisitePour23;
											echo'
											<style>
												.grapBarreAv23{
													height : '.$graphVisitePour23.'%;
													position : relative;
													top : '.$graphCompen23.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv23">
													<div class = "nb">
														'.$graphVisiteNb23.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph24 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph24->execute(array($annees, $mois, 24));
											$graphVisiteNb24 = $graph24->rowCount();
											$graphVisitePour24 = ($graphVisiteNb24 * 100) / $echelle;
											$graphCompen24 = 100 - $graphVisitePour24;
											echo'
											<style>
												.grapBarreAv24{
													height : '.$graphVisitePour24.'%;
													position : relative;
													top : '.$graphCompen24.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv24">
													<div class = "nb">
														'.$graphVisiteNb24.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph25 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph25->execute(array($annees, $mois, 25));
											$graphVisiteNb25 = $graph25->rowCount();
											$graphVisitePour25 = ($graphVisiteNb25 * 100) / $echelle;
											$graphCompen25 = 100 - $graphVisitePour25;
											echo'
											<style>
												.grapBarreAv25{
													height : '.$graphVisitePour25.'%;
													position : relative;
													top : '.$graphCompen25.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv25">
													<div class = "nb">
														'.$graphVisiteNb25.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph26 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph26->execute(array($annees, $mois, 26));
											$graphVisiteNb26 = $graph26->rowCount();
											$graphVisitePour26 = ($graphVisiteNb26 * 100) / $echelle;
											$graphCompen26 = 100 - $graphVisitePour26;
											echo'
											<style>
												.grapBarreAv26{
													height : '.$graphVisitePour26.'%;
													position : relative;
													top : '.$graphCompen26.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv26">
													<div class = "nb">
														'.$graphVisiteNb26.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph27 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph27->execute(array($annees, $mois, 27));
											$graphVisiteNb27 = $graph27->rowCount();
											$graphVisitePour27 = ($graphVisiteNb27 * 100) / $echelle;
											$graphCompen27 = 100 - $graphVisitePour27;
											echo'
											<style>
												.grapBarreAv27{
													height : '.$graphVisitePour27.'%;
													position : relative;
													top : '.$graphCompen27.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv27">
													<div class = "nb">
														'.$graphVisiteNb27.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph28 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph28->execute(array($annees, $mois, 28));
											$graphVisiteNb28 = $graph28->rowCount();
											$graphVisitePour28 = ($graphVisiteNb28 * 100) / $echelle;
											$graphCompen28 = 100 - $graphVisitePour28;
											echo'
											<style>
												.grapBarreAv28{
													height : '.$graphVisitePour28.'%;
													position : relative;
													top : '.$graphCompen28.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv28">
													<div class = "nb">
														'.$graphVisiteNb28.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph29 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph29->execute(array($annees, $mois, 29));
											$graphVisiteNb29 = $graph29->rowCount();
											$graphVisitePour29 = ($graphVisiteNb29 * 100) / $echelle;
											$graphCompen29 = 100 - $graphVisitePour29;
											echo'
											<style>
												.grapBarreAv29{
													height : '.$graphVisitePour29.'%;
													position : relative;
													top : '.$graphCompen29.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv29">
													<div class = "nb">
														'.$graphVisiteNb29.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph30 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph30->execute(array($annees, $mois, 30));
											$graphVisiteNb30 = $graph30->rowCount();
											$graphVisitePour30 = ($graphVisiteNb30 * 100) / $echelle;
											$graphCompen30 = 100 - $graphVisitePour30;
											echo'
											<style>
												.grapBarreAv30{
													height : '.$graphVisitePour30.'%;
													position : relative;
													top : '.$graphCompen30.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv30">
													<div class = "nb">
														'.$graphVisiteNb30.'
													</div>
												</div>
											</div>
										</td>
										<td class = "graph grapColl">
											';
											$graph31 = $bdd->prepare('SELECT * FROM visite WHERE annees = ? AND mois = ? AND jours = ?');
											$graph31->execute(array($annees, $mois, 31));
											$graphVisiteNb31 = $graph31->rowCount();
											$graphVisitePour31 = ($graphVisiteNb31 * 100) / $echelle;
											$graphCompen31 = 100 - $graphVisitePour31;
											echo'
											<style>
												.grapBarreAv31{
													height : '.$graphVisitePour31.'%;
													position : relative;
													top : '.$graphCompen31.'%;
												}
											</style>
											<div class = "grapBarreArr">
												<div class = "grapBarreAv grapBarreAv31">
													<div class = "nb">
														'.$graphVisiteNb31.'
													</div>
												</div>
											</div>
										</td>
							
									</tr>
									<tr>
										<td class = "graph graph2 graph3">
											0
										</td>
										';
										for($boucle = 1; $boucle <= 31; $boucle++){
											echo'<td class = "graph graph2">
												'.$boucle.'
											</td>';
										}
										echo'
							
									</tr>
								</table>';
							?>
						</div>
					</div>
				</div>
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
