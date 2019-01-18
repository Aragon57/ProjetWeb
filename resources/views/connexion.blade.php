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
                   <?php include('C:\Users\nicol\webLaravel\resources\views\nav.blade.php'); ?>


    <body>
   



   
   <!--Made with love by Mutiullah Samim -->
   
    <!--Bootsrap 4 CDN-->
   
</head>
<body class="co">
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>SE CONNECTER</h3>
             
            </div>
            <div class="card-body">
                <form>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="emails" name="emails" placeholder="Email" class="form-control" >
                        
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
                <div class="d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

    </form>
    </body>

                   <?php include('C:\Users\nicol\webLaravel\resources\views\footer.blade.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</html>