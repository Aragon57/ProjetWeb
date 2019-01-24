@php
	$_SESSION['id'] = 333;	
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
											<input type="number" class="form-control text-center" value="{{ $item->quantity }}">
										</td>
										<td data-th="Subtotal" class="text-center">{{ $subtotal }}</td>
										<td class="actions" data-th="">
											<button class="btn btn-info btn-sm" onclick="deleteArticle({{ $item->id_product }});"><i class="fas fa-sync-alt"></i></button>
											<button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>								
										</td>
									</tr>
								</tbody>
							@endforeach

					        <tfoot class="footer">
						        <tr class="visible-xs">
							        <td class="text-center"><strong>Total {{ $total }}</strong></td>
						        </tr>
						        <tr>
							        <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							        <td colspan="2" class="hidden-xs"></td>
							        <td class="hidden-xs text-center"><strong>Total €{{ $total }}</strong></td>
							        <td><a href="#" id="checkout" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						        </tr>
					        </tfoot>
				        </table>
                    </div>
                </div>

                <div class="col-lg-1 col-md-2 col-sm-3 bg-dark"></div>
            </div>
		</div>
		<script>
			function deleteArticle(id) {
				@php
				@endphp
			}
		</script>
    </body>
</html>