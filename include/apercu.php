<?php
	session_start();
	if(isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] >= 0 && isset($_POST['membre']) && !empty($_POST['membre']) && $_POST['membre'] == $_SESSION['id']){
		include('../include/bdd.php');
		$apercu = $bdd->prepare('SELECT * FROM fichier WHERE id = ? AND lien_id = ?');
		$apercu->execute(array($_POST['id'], $_SESSION['id']));
		$apercuDonnee = $apercu->fetch();
		echo '
			<div class = "bg_spe apercu">
				<div class = "fen_comm fen_aper">
					<div class = "fermer_apercu_d"><label>X</label></div>
					<div class = "titre_comm">apercu</div>
					<div class = "cont_comm">
						';
						$ext = substr(strrchr($apercuDonnee['nom'], '.'), 1);
						if(in_array($ext, $img_ext)){
							echo'<img class = "img_apercu" src = "'.$domain.'/fichier/'.$_SESSION['id'].'/'.$apercuDonnee['nom'].'">';
						}
						else if(in_array($ext, $vid_ext)){
							echo'<video class = "img_apercu" src = "'.$domain.'/fichier/'.$_SESSION['id'].'/'.$apercuDonnee['nom'].'" controls></video>';
						}
						else if(in_array($ext, $sic_ext)){
							echo'<audio class = "img_apercu" src = "'.$domain.'/fichier/'.$_SESSION['id'].'/'.$apercuDonnee['nom'].'" controls></audio>';
						}
						else if($ext == $pdf_ext){
							echo'
								
								<a style = "float : left" class = "lien1" href = "'.$domain.'/pdf/?membre='.$_SESSION['id'].'&id='.$apercuDonnee['id'].'" target = "_Blank">
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
						$tTaille = strlen($apercuDonnee['taille']);
						if(0 <= $tTaille && $tTaille <= 3){
							$tTaille2 = $apercuDonnee['taille'].' o';
						}
						else if(4 <= $tTaille && $tTaille <= 6){
							$tTaille2 = substr($apercuDonnee['taille'], 0, $tTaille - 3).' Ko';
						}
						else if(7 <= $tTaille && $tTaille <= 9){
							$tTaille2 = substr($apercuDonnee['taille'], 0, $tTaille - 6).' Mo';
						}
						else if(10 <= $tTaille){
							$tTaille2 = substr($apercuDonnee['taille'], 0, $tTaille - 9).' Go';
						}
						echo'
						<div class = "descrip_apercu">
							<div class = "descrip_ligne">nom<div class = "descrip_ligne2">'.$apercuDonnee['nom'].'</div></div>
							<div class = "descrip_ligne">taille<div class = "descrip_ligne2">'.$tTaille2.'</div></div>
						</div>
					</div>
				</div>
			</div>
		';
	}
?>
