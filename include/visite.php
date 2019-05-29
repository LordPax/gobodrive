<?php	
	if(!isset($_COOKIE['visiteHard'])){
		$annees = date('Y');
		$mois = date('m');
		$jours = date('d');
		$visite = $bdd->prepare('INSERT INTO visite(lien_id, annees, mois, jours) VALUES(?, ?, ?, ?)');
		$visite->execute(array($_SESSION['id'], $annees, $mois, $jours));
		$temps = time() + 3600;
		setcookie('visiteHard', 'jai visiter', $temps, '/');
	}
?>
