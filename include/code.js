/*function ecran(){
	$(function(){
		long = $(window).height() - ($('footer').height() + 20);
		long3 = $(window).height() - ($('header').height() + ($('footer').height() - 70));
		long2 = $('.princip').height() + 20;
		if(long2 <= long){
			$('footer').css({
				'position' : 'absolute',
				'top' : long
			});
			$('.param').css({
				'height' : long3
			});
		}
		else{
			$('footer').css({
				'position' : 'static'
			});
			$('.param').css({
				'height' : long3
			});
		}
	});
}*/

function ecran(){
	$(function(){
		long = $(window).height() - ($('footer').height() + 20);
		long3 = $(window).height() - ($('header').height() + ($('footer').height() - 34));
		long2 = $(window).height() - ($('header').height() + ($('footer').height() + 10));
		long4 = $(window).height();
		
		$('footer').css({
			'position' : 'absolute',
			'top' : long
		});
		$('.util').css({
			'position' : 'absolute',
			'top' : long4 - 140,
			'left' : 7
		});
		$('.util2').css({
			'position' : 'absolute',
			'top' : long4 - 100,
			'left' : 7
		});
		$('.param').css({
			'height' : long3
		});
		$('.princip_taille').css({
			'height' : long2 + 9
		});
		$('.page_partage').css({
			'max-height' : long2 - 10,
			'overflow-y' : 'auto'
		});
		$('.fen_comm').css({
			'max-height' : long2 - 50,
			'overflow-y' : 'auto'
		});
		/*$('.barre_taille').css({
			'margin-top' : long2 - 220
		});*/
		$('.video').css({
			'height' : long4
		});
	});
}

$(function(){
	ecran();
	
	/*$('.apercu_form').submit(function(){
		id = $('#id').val();
		$.post('../include/apercu.php', {
			id : id
		}, function(donnees){
			$('.apercu_ici').html(donnees);
		});
		return false;
	});*/

/*==================================================================================*/

	$('.inscrip1').hide();
	$('.inscrip').addClass('use');
	$('.inscrip').click(function(){
		$('.connect1').hide();
		$('.connect').addClass('use');
		$('.inscrip1').show();
		$('.inscrip').removeClass('use');
		
	});
	$('.connect').click(function(){
		$('.inscrip1').hide();
		$('.inscrip').addClass('use');
		$('.connect1').show();
		$('.connect').removeClass('use');
	});

/*==================================================================================*/

	$('.msg').click(function(){
		$('.msgErr').slideUp();
		$('.msgBon').slideUp();
	});

/*==================================================================================*/

	if($(window).width() >= 800){
		$('.img_par2').click(function(){
			$('.param').animate({
				left : '0px',
			}, 400);
			$('.princip').animate({
				marginLeft : '270px',
			}, 400);
		});
	
		$('.img_par1').click(function(){
			$('.param').animate({
				left : '-230px',
			}, 400);
			$('.princip').animate({
				marginLeft : '2%',
			}, 400);
		});
	}
	else{
		$('.img_par2').click(function(){
			$('.param').animate({
				left : '0px',
			}, 400);
			$('.princip').animate({
				marginLeft : '2%',
			}, 400);
		});
	
		$('.img_par1').click(function(){
			$('.param').animate({
				left : '-230px',
			}, 400);
			$('.princip').animate({
				marginLeft : '2%',
			}, 400);
		});
	}
	
/*==================================================================================*/

	$('.importer').hide();
	$('.import').click(function(){
		$('.importer').show();
	});
	$('.fermer_import').click(function(){
		$('.importer').hide();
	});
	
	//$('.apercu').hide();
	/*$('.apercu_d').click(function(){
		$('.apercu').show();
	});*/
	/*$('.fermer_apercu_d').click(function(){
		$('.apercu').hide();
	});*/
	
/*==================================================================================*/
	
	$('.second_pseudo').hide();
	$('.modif_pseudo').click(function(){
		$('.second_pseudo').show();
		$('.prem_pseudo').hide();
	});
	$('.annul_pseudo').click(function(){
		$('.second_pseudo').hide();
		$('.prem_pseudo').show();
	});
	
	$('.second_nom').hide();
	$('.modif_nom').click(function(){
		$('.second_nom').show();
		$('.prem_nom').hide();
	});
	$('.annul_nom').click(function(){
		$('.second_nom').hide();
		$('.prem_nom').show();
	});
	
	$('.second_prenom').hide();
	$('.modif_prenom').click(function(){
		$('.second_prenom').show();
		$('.prem_prenom').hide();
	});
	$('.annul_prenom').click(function(){
		$('.second_prenom').hide();
		$('.prem_prenom').show();
	});
	
	$('.second_email').hide();
	$('.modif_email').click(function(){
		$('.second_email').show();
		$('.prem_email').hide();
	});
	$('.annul_email').click(function(){
		$('.second_email').hide();
		$('.prem_email').show();
	});
	
	$('.second_mdp').hide();
	$('.modif_mdp').click(function(){
		$('.second_mdp').show();
		$('.prem_mdp').hide();
	});
	$('.annul_mdp').click(function(){
		$('.second_mdp').hide();
		$('.prem_mdp').show();
	});
	
	$('.second_avatar').hide();
	$('.modif_avatar').click(function(){
		$('.second_avatar').show();
		$('.prem_avatar').hide();
	});
	$('.annul_avatar').click(function(){
		$('.second_avatar').hide();
		$('.prem_avatar').show();
	});
	
	/*==================================================================================*/
	$('.chargement').hide();
	$('.charge').click(function(){
		$('.chargement').show();
	});
});
