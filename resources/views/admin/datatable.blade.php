<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

	<script src="{{ asset('js/jquery.min.js') }}"></script>

	<title>Data - BDE Strasbourg</title>
</head>

<script>$(document).ready(()=>{getdata('/data');});</script>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="navbar-nav mr-auto">
			<button id="userbtn" class="btn btn-outline-success">Utilisateur</button>
			<button id="eventbtn" class="btn btn-outline-success">Evenement</button>
			<button id="commandbtn" class="btn btn-outline-success">Commande</button>
			<button id="articlebtn" class="btn btn-outline-success">Article</button>
		</div>

		<form id="search" class="form-inline my-2 my-lg-0">
			@csrf
			<input name="tableloaded" type="hidden" value="">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="filter">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</nav>
	
	<div class="table-responsive">
		<table id="datatable" class="table table-hover table-light table-bordered"></table>
	</div>
</body>

<script>
	function getdata(link)
	{
		$.get(link, (data, status)=>{
			console.log(status);

			$('#datatable').html(data);
			$('input[name=tableloaded]').val(link);
		});
	}
</script>
<script>
	$(document).ready(()=>{
		$('#userbtn').click(()=>{
			getdata('/data');
		});

		$('#eventbtn').click(()=>{
			getdata('/data/event');
		});

		$('#commandbtn').click(()=>{
			getdata('/data/command');
		})

		$('#articlebtn').click(()=>{
			getdata('/data/article');
		});

		$('#search').submit((event)=>{
			event.preventDefault();

			let send = $('#search');

			let link = $('input[name=tableloaded]').val();

			$.post(link, send.serialize(), (data, status)=>{
				console.log(status);

				$('#datatable').html(data);
			});
		});
	});
</script>

</html>