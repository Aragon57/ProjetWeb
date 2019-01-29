@php
function loadcard($item, $header)
{
	@endphp

	<!-- Chargement de la card d'un article -->
	<div class="card">
		<!-- image de l'article -->
		<img class="card-img-top" src="/storage/{{ $item->image }}" alt="Card image cap">
		<div class="card-block">
			<!-- Titre principale -->
			<h4 class="card-title nom-article">{{ $item->name }}</h4>
			<!-- Prix -->
			<p class="card-text prix-article">Prix: {{ $item->price }}€</p>
			<!-- Description -->
			<p class="card-text">{{ $item->description }}</p>
			@if(isset($_SESSION['email']))
			<!-- Bouton pour ajouter l'article au panier -->
			<button onclick="document.getElementById('product{{ $item->id }}').style.display='block'" class="addtocart-btn" type="submit"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
			@endif
			<!-- Verification de la session afin de faire apparaitre un bouton pour supprimer l'article si on est un membre du Bde -->
			@php if($header) { @endphp
			@if(isset($_SESSION['email']))
			@if($_SESSION['status']==4)
			<form action="/product/destroy" method="post">
				@csrf
				<input type="hidden" name="id_product" value ={{ $item->id }}>
				<button type="submit" class="addtocart-btn"><i class="fas fa-trash-alt"></i></button>
			</form>
			@endif
			@endif
			@php } @endphp
		</div>
	</div>

	@php
}
@endphp
