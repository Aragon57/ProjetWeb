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
        
    <body style ="background-color:#1d2124">
        <?php include('C:\Users\nicol\webLaravel\resources\views\nav.blade.php'); ?>
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



<div class="container-fluid text-center"> 
        <div class="container-fluid text-center"> 
            <br>
            <h1> Nos véhicules </h1>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-5">

                    <h2><br> Lamborghini URUS</h2>
                    <hr>
                    
                    <img id="Urus" class="img-responsive" src="./image/UrusDay.jpg" width="100%"  alt="Third slide">
                    <div clas="container-fluid text-left">
                        <br>
                            <p>105 000 $</p>
                    <a class ="btn btn-secondary" href="Urus.html"> Ajouter au panier >> </a>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini AVENTADOR</h2>
                                        <hr>

                    
                    <img id="Aventador" class="img-responsive" src="./image/giphy.gif" width="100%"   alt="Third slide">
                        <div clas="container-fluid text-left">
                        <br>
                        <p>205 000 $</p>
                    <a class ="btn btn-secondary" href="Aventador.html"> Ajouter au panier >> </a>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini HURACAN</h2>
                                        <hr>

                    
                    <img id="Huracan" class="img-responsive" src="./image/huracanDay.jpg" width="100%" alt="Third slide">
                    <div clas="container-fluid text-left">
                        <br>
                            <p>320 000 $</p>
                    <a class ="btn btn-secondary" href="Huracan.html"> Ajouter au panier >> </a>
                    </div>



                    <hr>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini Centenario </h2>
                    <hr>
                    
                    <img id="Urus" class="img-responsive" src="./image/Lamborghini-Centenario.jpg" width="100%"  alt="Third slide">
                    <div clas="container-fluid text-left">
                        <br>
                            <p>105 000 $</p>
                    <a class ="btn btn-secondary" href="Urus.html"> Ajouter au panier >> </a>
                    </div>
                    <hr>
                </div>
            <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini Veneno </h2>
                    <hr>
                    
                    <img id="Urus" class="img-responsive" src="./image/56959.jpg" width="100%"  alt="Third slide">
                    <div clas="container-fluid text-left">
                        <br>
                            <p>105 000 $</p>
                    <a class ="btn btn-secondary" href="Urus.html"> Ajouter au panier >> </a>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini Asterion</h2>
                                        <hr>

                    
                    <img id="Aventador" class="img-responsive" src="./image/53385.jpg" width="100%"   alt="Third slide">
                        <div clas="container-fluid text-left">
                        <br>
                        <p>205 000 $</p>
                    <a class ="btn btn-secondary" href="Aventador.html"> Ajouter au panier >> </a>
                    </div>
                    <hr>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini Estoque</h2>
                                        <hr>

                    
                    <img id="Huracan" class="img-responsive" src="./image/estoque.jpg" width="100%" alt="Third slide">
                    <div clas="container-fluid text-left">
                        <br>
                            <p>320 000 $</p>
                    <a class ="btn btn-secondary" href="Huracan.html"> Ajouter au panier >> </a>
                    </div>



                    <hr>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5">
                    <h2><br> Lamborghini Huracan Spyder</h2>
                    <hr>
                    
                    <img id="Urus" class="img-responsive" src="./image/HuracanSpyder.jpg" width="100%"  alt="Third slide">
                    <div clas="container-fluid text-left">
                        <br>
                            <p>105 000 $</p>
                    <a class ="btn btn-secondary" href="Urus.html"> Ajouter au panier >> </a>
                    </div>
                    <hr>
                </div>

            </div>

        </div>
    </body>
    <?php include('C:\Users\nicol\webLaravel\resources\views\footer.blade.php'); ?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</html>
