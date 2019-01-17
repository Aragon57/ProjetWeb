<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('fontawesome/style.css') }}" rel="stylesheet">

        <title>Laravel</title>
        <!-- Fonts -->
      
        <!-- Styles -->
        
    <body style ="background-color:#1d2124">

                <?php include('C:\Users\nicol\webLaravel\resources\views\nav.blade.php'); ?>

<div class ="text align-center">
    <form action="/inscription" method="post">
    	        {{ csrf_field() }}
    	                <input type="name" name="name" placeholder="Nom">
        <input type="firstname" name="firstname" placeholder="Prénom">
        <input type="localisation" name="localisation" placeholder="Localisation">

        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="password" name="password_confirmation" placeholder="Mot de passe (confirmation)">
        <input type="submit" value="M'inscrire">
    </form>

   </body>
                   <?php include('C:\Users\nicol\webLaravel\resources\views\footer.blade.php'); ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
