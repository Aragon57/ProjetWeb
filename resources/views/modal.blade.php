@php
@endphp
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="{{ asset('css/modal.css') }}" rel="stylesheet">

<script>
	function hide(){
		document.getElementById('accepted').style.visibility = "hidden"; //rendre la fenetre invisible
		@php $_SESSION['cookie'] = 'az'; @endphp
	}
</script>
<!------ Include the above in your HEAD tag ---------->
<div id="accepted" class="cookie-accept d-block position-fixed mw-25 bg-primary text-white rounded-top pt-2 pr-3 pl-3 pb-2 text-center" >
	<h5>Notre site utilise les cookies !</h5>
	<p>Nous recueillons des informations relatives à votre connexion et à votre navigation grâce à l'utilisation des cookies.
		<br>Pour en savoir plus, dirigez vous vers notre politique de confidentialité.
		<br> En utilisant notre site, vous acceptez l'utilisation des cookies. <br>
		
	</p>
<button  onClick='hide()'  class="btn btn-outline-light btn-block">Oui, j'accepte.</a>

</div>