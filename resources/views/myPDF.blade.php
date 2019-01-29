<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<!-- Mise en page de notre PDF -->
		<h1> Liste des inscrits </h1>
		<!-- Foreach pour récupérer l'ensemble des inscrits de l'événement -->
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