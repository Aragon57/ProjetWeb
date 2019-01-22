<?php session_start(); ?>
<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    <title>Laravel</title>
    <!-- Fonts -->
    <!-- Styles -->
</head>
    <body style ="background-color:#1d2124" class="co">

        <?php //include('C:\Users\nicol\webLaravel\resources\views\nav.blade.php'); ?>



        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="cardsignin">
                    <div class="card-header">
                        <h3>S'INSCRIRE</h3>
                        <p id="error"></p>
                    </div>
                    <div class="card-body">
                        <form action="/inscription" method="post">
                            @csrf

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="name" name="name" placeholder="Nom" require="required" class="form-control" >

                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="firstname" name="firstname" placeholder="Prénom" require="required" class="form-control" >

                            </div>
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" name="email" placeholder="Email" require="required" class="form-control" >

                            </div>
                            
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
<SELECT class="form-control" name="localisation" size="1">
                                <OPTION>Strasbourg 
                                    <OPTION>Nancy
                                        <OPTION>Reims
                                            <OPTION>Dijon
                                                <OPTION>Lyon
                                                <OPTION>Arras 
                                                <OPTION>Brest
                                                <OPTION>Saint-Nazaire 
                                                <OPTION>Strasbourg 
                                                <OPTION>Bordeaux 
                                                <OPTION>Nice 
                                                <OPTION>Pau 
                                                <OPTION>Toulouse 
                                                <OPTION>Angoulême 
                                                <OPTION>Grenoble 
                                                <OPTION>La Rochelle
                                                <OPTION>Châteauroux 
                                                <OPTION>Paris Nanterre 
                                                <OPTION>Le Mans
                                                <OPTION>Caen 
                                                <OPTION>Rouen 
                                                <OPTION>Lille
                                                <OPTION>Montpellier
                                                <OPTION>Nantes
                                                <OPTION>Orléans
                                                </SELECT>
                            </div>




                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password" placeholder="Mot de passe" require="required" class="form-control" >
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="password_confirmation" placeholder="Mot de passe (confirmation)" require="required" class="form-control" >
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Vous n'avez pas encore de compte?<a href="#">Inscrivez-vous</a>
                    </div>
                    <div class="d-flex justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>








<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script>
    $(document).ready(() => {
        $('form').submit((event)=>{
            event.preventDefault();
            var form = $('form');

            $.ajax({
                type : 'POST',
                url : '/inscription',
                data : form.serialize(),
                dataType : 'text',
                encode : true,
                success : (data) => {
                    document.location.href='/';
                },
                error : (data) => {
                    document.getElementById("error").innerHTML = data['responseText'];
                }
            });
        });
    });
</script>


</html>
