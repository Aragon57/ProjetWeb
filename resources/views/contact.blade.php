<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
   
    <title> Contact </title>
	
    <!-- Bootstrap core CSS -->
 <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/contact.css') }}" rel="stylesheet">
 <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
 

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


</head>
<!-- navbar -->
@include('nav')
<body>
 
  
<br>
<br>

	
	<h1 class="blanc text-center"> Contact : </h1>
	<hr class="blanc">
	 
<div class="container">
<!--Creation de l'emplacement des box -->

	<div class="box">	
	<!--adresse -->
		<div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
		<div class='details'><h3> 67380 Lingolsheim FRANCE</h3></div>
	</div>
	
	<div class="box">
	<!--Telephone-->
		<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
		<div class='details'><h3>06 78 56 52 00</h3></div>
	</div>
	
	<div class="box">
	<!--Mail -->
		<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
		<div class='details'><h3>bde.stras@viacesi.fr</h3></div>
	</div>
</div>

	 <!-- FOOTER -->
	@include('footer');
	
  
   </body>
</html>