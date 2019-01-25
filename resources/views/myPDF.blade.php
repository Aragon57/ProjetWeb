<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
	
	<h1> Liste des inscrits </h1>

	@foreach($inscrit as $inscritt)
	
	  	{{$inscritt->email}}

	<br>
	@endforeach


	@php
	if(empty($inscrit)){
	@endphp

	<h4> Aucun inscrit </h4>
@php
}
@endphp
  </body>
</html>