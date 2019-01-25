$(function () {

	$('.tri').click(function () {
		var element_clique = $(this);

		//Si clic sur l'element alors qu'il est déjà actif => on réaffiche tous les articles
		if (element_clique.hasClass('active-tri')) {
			element_clique.removeClass('active-tri');
			$('.article').show();
			return;
		}

		//Si clic sur un bouton mais qu'un autre tri est déjà actif on l'annule
		if ($('.tri').hasClass('active-tri')) {
			$('.tri').removeClass('active-tri');
			$('.article').show();
		}

		//Si clic sur un bouton mais qu'un autre tri est déjà actif on l'annule     
		if (element_clique.hasClass('active-tri')) {
			element_clique.removeClass('active-tri');
			$('.article').show();
		} else {
			console.log('here');
			var categorie = element_clique.attr("value");
			element_clique.addClass('active-tri');
			$('.article').not('.' + categorie).hide();
		}

	});

});

