<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('fontawesome/css/style.css') }}" rel="stylesheet">

	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.js') }}"></script>
	<script src="{{ asset('js/bootstrap.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<title>Panier - BDE CESI Strasbourg</title>
</head>

<body>

	<!-- Barre de navigation -->
	@include('layouts/nav')

	<!-- Table contenant les articles -->
	<div class="container-fluid text-center cart-div"> 
		<div class="row">
			<div class="col-lg-1 col-md-2 col-sm-3 bg-white"></div>

			<div class="col-lg-10 col-md-20 col-sm-30" style="height: 100vh;">
				<div class="container">
					<table id="cart" class="table table-hover table-condensed">
						<thead>
							<tr>
								<th style="width:50%">Product</th>
								<th style="width:10%">Price</th>
								<th style="width:8%">Quantity</th>
								<th style="width:22%" class="text-center">Subtotal</th>
								<th style="width:10%"></th>
							</tr>
						</thead>
						<tbody>
						<!-- Initialisation de la variable globale et recuperation des articles  -->
						@php
						
						$total = 0;
						@endphp

						@if(isset($_SESSION['id_cart']))
						@foreach ($articles as $item)
						@php
						$article = App\product::find($item->id_product);
						$subtotal = $item->quantity * $article->price;
						$total += $subtotal;
						@endphp

						<!-- Affichage des articles -->
						
							<tr>
								<td data-th="Product">
									<div class="row">
										<div class="col-sm-2 hidden-xs"><img src="/storage/{{ $article->image }}" alt="..." class="img-responsive img-product"/></div>
										<div class="col-sm-10">
											<h4 class="nomargin">{{ $article->name }}</h4>
											<p>{{ $article->description }}</p>
										</div>
									</div>
								</td>
								<td data-th="Price">{{ $article->price }}</td>
								<td data-th="Quantity">
									<input id="qinput{{ $item->id }}" type="number" class="form-control text-center" value="{{ $item->quantity }}">
								</td>
								<td data-th="Subtotal" class="text-center">{{ $subtotal }}</td>
								<td class="actions" data-th="">
									<button onclick="$('#quantity{{ $item->id }}').submit();" class="btn btn-info btn-sm"><i class="fas fa-sync-alt"></i></button>
									<button onclick="$('#delete{{ $item->id }}').submit();" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>								
								</td>
							</tr>
						
						<tr class="hider">
							<td>
						<!-- Supprimer un article du panier -->
						<form id="delete{{ $item->id }}">
							@csrf
							<input type="hidden" name="id" value="{{ $item->id }}">
						</form>

						<!-- Changer la quantité -->
						<form id="quantity{{ $item->id }}">
							@csrf
							<input type="hidden" name="id" value="{{ $item->id }}">
							<input type="hidden" name="quantity" value="">
						</form>
					</td>
						</tr>
						<!-- Script de supression et de quantité -->
						<script>
							$(document).ready(() => {
								$('#delete{{ $item->id }}').submit((event) => {
									event.preventDefault();

									var form = $('#delete{{ $item->id }}');

									$.ajax({
										type : 'DELETE',
										url : '/product',
										data : form.serialize(),
										dataType : 'text',
										encode : true,
										success : (data) => {
											console.log(data);
											document.location.href="/cart";
										},
										error : (data) => {
											console.log(data);
										}
									});
								});



								$('#quantity{{ $item->id }}').submit((event)=>{
									event.preventDefault();

									$('input[name=quantity]').val($('#qinput{{ $item->id }}').val());
									let form = $('#quantity{{ $item->id }}');

									$.ajax({
										type : 'PUT',
										url : '/product',
										data : form.serialize(),
										dataType : 'text',
										encode : true,
										success : (data) => {
											console.log(data);
											document.location.href="/cart";
										},
										error : (data) => {
											console.log(data);
										}
									});
								});
							});
						</script>
						@endforeach
						@endif
						</tbody>

						<!-- Footer du panier avec le prix total, ect... -->
						<tfoot class="footer">
							<tr class="visible-xs">
								<td class="text-center"><strong>Total HT {{ $total - ($total*1/5) }}</strong></td>
								<td class="text-center"><strong>Tax 20%</strong></td>
								<td class="text-center"><strong>TTC {{ $total }}€</strong></td>
							</tr>
							<tr>
								<td><a href="/boutique" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
								<td colspan="2" class="hidden-xs"></td>
								<td class="hidden-xs text-center"><strong>Total {{ $total }}€</strong></td>
								<td><button onclick="document.getElementById('id01').style.display='block'" class="btn btn-success btn-block">Valider <i class="fa fa-angle-right"></i></button></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

			<!-- Pop-up permettant de choisir le moyen de paiement -->
			<div class="w3-container">
				<div id="id01" class="w3-modal">
					<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:3000px">
						<div class="w3-center"><br>
							<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
						</div>

						<form class="w3-container" action="/validationCommand" method="get">
							<div id="payement-btn" class="w3-section">
								<button id="payer-liquide" class="ok-btn" style="margin: 10px">Payer en liquide</button>
								<div id="paypal-button"></div>
							</div>

							<p id="payement-error" style="display: none">Une erreur est survenue, veuillez reesayer plutard</p>

							<p id="payement-success" style="display: none">Une demande a été envoyé vers un administrateur competent qui prendra contact avec vous dans les plus bref delais</p>
						</form>
					</div>
				</div>
			</div>

			<div class="col-lg-1 col-md-2 col-sm-3 bg-dark"></div>
		</div>
	</div>

	<!-- Footer de la page -->
    @include('footer')

	<!-- Script pour payer en liquide -->
	<script>
		$(document).ready(()=>{
			$('#payer-liquide').click(()=>{
				$.get('/validatecommand', {
					success : (data) => {
						$('#payement-btn').style.display='none';
						$('#payement-success').style.display='block';
					},
					error : (data) => {
						$('#payement-btn').style.display='none';
						$('#payement-error').style.display='block';
					}
				});
			});
		});
	</script>

	<!-- Script pour payer avec paypal -->
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script>
		paypal.Button.render({
		// Configuration de l'environnement
		env: 'sandbox',
		client: {
			sandbox: 'demo_sandbox_client_id',
			production: 'demo_production_client_id'
		},
		// Boutton 
		locale: 'fr_FR',
		style: {
			size: 'small',
			color: 'silver',
			shape: 'rect',
		},

		commit: true,

		// Préparation au paiement
		payment: function(data, actions) {
			return actions.payment.create({
				transactions: [{
					amount: {
						total: '0.01',
						currency: 'EUR'
					}
				}]
			});
		},

		// Execution du paiement
		onAuthorize: function(data, actions) {
			return actions.payment.execute().then(function() {

			// Message de confirmation
			window.alert('Merci pour votre achat');
		});
		}
	}, '#paypal-button');

</script>


</body>
</html>