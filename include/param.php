<div class = "param">
	<img src = "<?php echo$domain;?>/images/img_par_2.png" class = "img_par img_par1">
	<div class = "ens_param">
		<?php
			if(isset($_SESSION['id']) && isset($_GET['membre']) && $_SESSION['id'] == $_GET['membre']){
		?>
		<a class = "par <?php if($_SERVER['PHP_SELF'] == '/bureau/index.php')echo'use_par';?>" href = "<?php echo$domain;?>/bureau/?membre=<?php echo $_SESSION['id'];?>">Bureau</span>
		<a class = "par <?php if($_SERVER['PHP_SELF'] == '/parametre/index.php' || $_SERVER['PHP_SELF'] == '/parametre/extention/index.php' || $_SERVER['PHP_SELF'] == '/parametre/moncompte/index.php')echo'use_par';?>" href = "<?php echo$domain;?>/parametre/?membre=<?php echo $_SESSION['id'];?>">Paramètre</a>
		<?php
			if($info['admin'] == 1){
				echo'<a class = "par '; if($_SERVER['PHP_SELF'] == '/stat/index.php')echo'use_par';echo'" href = "'.$domain.'/stat/?membre='.$_SESSION['id'].'">statistique</a>';
			}
		?>
		<a class = "par" href = "<?php echo$domain;?>/include/deconnection.php">Déconnection</a>
		
		<?php
			$taillePers = $bdd->prepare('SELECT taille_max FROM utilisateur WHERE id = ?');
			$taillePers->execute(array($_SESSION['id']));
			$tailleFic = $bdd->prepare('SELECT SUM(taille) AS tailleFic FROM fichier WHERE lien_id = ?');
			$tailleFic->execute(array($_SESSION['id']));
			$taillePersNum = $taillePers->fetch();
			$tailleFicNum = $tailleFic->fetch();
			$tPers = strlen($taillePersNum['taille_max']);
			$tFic = strlen($tailleFicNum['tailleFic']);
			
			if(0 <= $tPers && $tPers <= 3){
				$tPers2 = $taillePersNum['taille_max'].' o';
			}
			else if(4 <= $tPers && $tPers <= 6){
				$tPers2 = substr($taillePersNum['taille_max'], 0, $tPers - 3).' Ko';
			}
			else if(7 <= $tPers && $tPers <= 9){
				$tPers2 = substr($taillePersNum['taille_max'], 0, $tPers - 6).' Mo';
			}
			else if(10 <= $tPers){
				$tPers2 = substr($taillePersNum['taille_max'], 0, $tPers - 9).' Go';
			}
			
			if(0 == $tFic){
				$tFic2 = '0 o';
			}
			else if(1 <= $tFic && $tFic <= 3){
				$tFic2 = $tailleFicNum['tailleFic'].' o';
			}
			else if(4 <= $tFic && $tFic <= 6){
				$tFic2 = substr($tailleFicNum['tailleFic'], 0, $tFic - 3).' Ko';
			}
			else if(7 <= $tFic && $tFic <= 9){
				$tFic2 = substr($tailleFicNum['tailleFic'], 0, $tFic - 6).' Mo';
			}
			else if(10 <= $tFic){
				$tFic2 = substr($tailleFicNum['tailleFic'], 0, $tFic - 9).' Go';
			}
			
			$pourcent = (100 * $tailleFicNum['tailleFic']) / $taillePersNum['taille_max'];
			echo'
				<div class = "util">
					<div class = "barre_taille">
						<div class = "barre_taille2" style = "width : '.$pourcent.'%"></div>
					</div>
					<div class = "taille_d">'.$tFic2.' / '.$tPers2.'</div>
					<div class = "foot">Copyright &copy Gobo Drive | <a href = "'.$domain.'/apropos/?membre='.$_SESSION['id'].'" class = "lien">a propos</a> </div>
				</div>
			';
		?>
		<?php
			}
			else{
				echo'
				<div class = "util2">
					<div class = "foot">Copyright &copy Gobo Drive | <a href = "'.$domain.'/apropos/" class = "lien">a propos</a> </div>
				</div>
				';
			}
		?>
	</div>
</div>
