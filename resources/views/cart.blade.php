@php
	$_SESSION['id'] = 333;
	unset($_SESSION['id_cart']);	
@endphp
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('css/boutique.css') }}" rel="stylesheet">
		<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
		<link href="{{ asset('fontawesome/css/style.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <title>Panier - BDE CESI Strasbourg</title>
    </head>

    <body>
        @include('layouts/nav')

        <div class="container-fluid text-center"> 
            <div class="row">
                <div class="col-lg-1 col-md-2 col-sm-3 bg-dark"></div>

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

							@php
							//jquery bug
								$total = 0;
							@endphp

							@foreach ($articles as $item)
								@php
									$article = App\product::find($item->id_product);
									$subtotal = $item->quantity * $article->price;
									$total += $subtotal;
								@endphp

								<tbody>
									<tr>
										<td data-th="Product">
											<div class="row">
											<div class="col-sm-2 hidden-xs"><img src="http://127.0.0.1:8000/{{ $article->image }}" alt="..." class="img-responsive img-product"/></div>
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
								</tbody>
								<form id="delete{{ $item->id }}">
									@csrf
									<input type="hidden" name="id" value="{{ $item->id }}">
								</form>

								<form id="quantity{{ $item->id }}">
									@csrf
									<input type="hidden" name="id" value="{{ $item->id }}">
									<input type="hidden" name="quantity" value="">
								</form>
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
													},
													error : (data) => {
														console.log(data);
													}
												});
											});
										});
									</script>
							@endforeach

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
	</body>
	<script>
		$(document).ready(()=>{
			$('#payer-liquide').click(()=>{
				$.get('/validationCommand', {
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
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script>
	  paypal.Button.render({
		// Configure environment
		env: 'sandbox',
		client: {
		  sandbox: 'demo_sandbox_client_id',
		  production: 'demo_production_client_id'
		},
		// Customize button (optional)
		locale: 'fr_FR',
		style: {
		  size: 'small',
		  color: 'silver',
		  shape: 'rect',
		},
	
		// Enable Pay Now checkout flow (optional)
		commit: true,
	
		// Set up a payment
		payment: function(data, actions) {
		  return actions.payment.create({
			transactions: [{
			  amount: {
				total: '0.01',
				currency: 'USD'
			  }
			}]
		  });
		},
		// Execute the payment
		onAuthorize: function(data, actions) {
		  return actions.payment.execute().then(function() {
			// Show a confirmation message to the buyer
			window.alert('Thank you for your purchase!');
		  });
		}
	  }, '#paypal-button');
	
	</script>
</html>