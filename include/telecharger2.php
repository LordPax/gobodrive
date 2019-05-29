<?php
	if(isset($_GET['id']) && !empty($_GET['id']) && $_GET['id'] >= 0){	
		include('bdd.php');
		$fichier = $bdd->prepare('SELECT * FROM fichier WHERE id = ?');
		$fichier->execute(array($_GET['id']));
		$nom = $fichier->fetch();
		if($nom['partage'] == 1){
			header('Cache-Control: public');
			//header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$nom['nom'].';');
			readfile('../fichier/'.$nom['lien_id'].'/'.$nom['nom']);
			
			$annees = date('Y');
			$mois = date('m');
			$jours = date('d');
			$telecharge = $bdd->prepare('INSERT INTO telecharge(lien_fichier, annees, mois, jours) VALUES(?, ?, ?, ?)');
			$telecharge->execute(array($_GET['id'], $annees, $mois, $jours));
		}
		else{
			header('location:'.$domain);
		}
	}	
?>
