<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

	<script src="{{ asset('js/jquery.min.js') }}"></script>

	<title>Data - BDE Strasbourg</title>
</head>

<script>$(document).ready(()=>{getdata();});</script>

<body>
	<nav class="navbar navbar-light bg-light">
		<div class="navbar-nav mr-auto">
			<button id="userbtn" class="btn btn-outline-success">Utilisateur</button>
			<button id="eventbtn" class="btn btn-outline-success">Evenement</button>
		</div>

		<form class="form-inline my-2 my-lg-0">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
		</form>
	</nav>
	
	<div class="table-responsive">
		<table id="datatable" class="table table-hover table-light table-bordered"></table>
	</div>
</body>

<script>
	function getdata()
	{
		$.get('/data', (data, status)=>{
			console.log(status);

			$('#datatable').html(data);
		});
	}
</script>
<script>
	$(document).ready(()=>{
		$('#userbtn').click(()=>{
			getdata();
		});

		$('#eventbtn').click(()=>{

		});
	});
</script>

</html>