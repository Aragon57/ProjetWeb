<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">


        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/boutique.css') }}" rel="stylesheet">
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

					        <tbody>
						        <tr>
							        <td data-th="Product">
								        <div class="row">
									        <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
									        <div class="col-sm-10">
										        <h4 class="nomargin">Product 1</h4>
										        <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
									        </div>
								        </div>
							        </td>
							        <td data-th="Price">$1.99</td>
							        <td data-th="Quantity">
								        <input type="number" class="form-control text-center" value="1">
							        </td>
							        <td data-th="Subtotal" class="text-center">1.99</td>
							        <td class="actions" data-th="">
								        <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
								        <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
							        </td>
						        </tr>
					        </tbody>

					        <tfoot>
						        <tr class="visible-xs">
							        <td class="text-center"><strong>Total 1.99</strong></td>
						        </tr>
						        <tr>
							        <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							        <td colspan="2" class="hidden-xs"></td>
							        <td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
							        <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
						        </tr>
					        </tfoot>
				        </table>
                    </div>
                </div>

                <div class="col-lg-1 col-md-2 col-sm-3 bg-dark"></div>
            </div>
        </div>
    </body>

    <script>
        $(document).ready(() => {
            $.get('/fetchcart', (data, status)=>{
                
            });
        });
    </script>
</html>