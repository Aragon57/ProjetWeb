<?php session_start() ?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link href= "{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href= "{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>


        <title>Laravel</title>
        <!-- Fonts -->
      
        <!-- Styles -->
    <body style ="background-color:#1d2124">
        <?php include('C:\Users\nicol\webLaravel\resources\views\layouts\nav.blade.php'); ?>
     

    <div class="container-fluid text-center "> 
        <div class="container-fluid text-center"> 
            <div class="row">
                <div class="col-lg-1 col-md-2 col-sm-3 ">
                    
                </div>
                <div class="col-lg-10 col-md-20 col-sm-30 ">
                     <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img  src="https://images.radio-canada.ca/q_auto,w_1600/v1/ici-info/16x9/tomorrowland-festival-belgique.jpg" height = "600"width="100% /9" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="img-responsive" src="https://www.kelcible.fr/wp-content/uploads/boutique-en-ligne.jpg"  height = "600" width="100% /9" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="img-responsive" src="http://chartreuse-liege.be/wp-content/uploads/2017/12/idee.jpg" height = "600" width="100% /9" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" ></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
                </div>
                <div class="col-lg-1 col-md-2 col-sm-3">
                   
               




                  
                </div>
            </div>
        </div>
    </div>
    </body>

    <?php include('C:\Users\nicol\webLaravel\resources\views\footer.blade.php'); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
</html>
