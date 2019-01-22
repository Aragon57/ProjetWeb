<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
        <title>Titre de ma page</title>
    </head>

    <body class="co">

        @include('layouts/nav');

        <div class="container">
            <div class="d-flex justify-content-center h-100">
                <div class="card">
                    <div class="card-header">
                        <h3>SE CONNECTER</h3>
                        <p id="error"></p>
                    </div>
                    <div class="card-body">
                        <form action="/connexion" method="post">
                        @csrf
                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="email" name="email" placeholder="Email" class="form-control" >
                            </div>

                            <div class="input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" name="password" placeholder="Mot de passe" class="form-control" >
                            </div>
                  
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                    Vous n'avez pas encore de compte?<a href="/inscription">Inscrivez-vous</a>
                    </div>
                    <div class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
</body>

    <?php //include('C:\Users\nicol\webLaravel\resources\views\footer.blade.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            $('form').submit((event) => {
                event.preventDefault();

                var form = $('form');

                $.ajax({
                    type : 'POST',
                    url : '/connexion',
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