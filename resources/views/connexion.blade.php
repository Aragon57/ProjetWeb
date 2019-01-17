<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Titre de ma page</title>
    </head>
    <body>
   
<div class ="text align-center">
    <form action="/connexion" method="post">
    	        {{ csrf_field() }}
    	                <input type="email" name="email" placeholder="email">

        <input type="password" name="password" placeholder="Mot de passe">
        <input type="submit" value="Se Connecter">
    </form>
    </body>
</html>