<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Boutique BDE Strasbourg</title>
  
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boutique.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/style.css') }}" rel="stylesheet">

</head>

  <body>


       <!-- Nav bar -->


    <!-- Premier container-->

        <div class="container-fluid text-center"> 
        <div class="row">

                <div class="col-lg-1 col-md-2 col-sm-3 bg-dark">
                </div>

                <div class="col-lg-10 col-md-20 col-sm-30">
                <hr>
                <h2>Bienvenue sur notre boutique</h2>

                <hr>
                <br>
                
              
                  <div class="col-lg-12 col-md-24 col-sm-36" > 
                  <h4 id="searchtitle" align="left" >Recherchez un article </h4>

                  <div class="recherche_p">
                    <form class="searchbox" action="/search" method="get">
                      <input type="text" placeholder="" name="q">
                      <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                  </div>
                  </div>

              
               <br> 
               <hr>

              <div class="col-lg-12 col-md-24 col-sm-36">        
               <h4> Nos meilleures ventes</h4>
              </div>
              <hr>
              <br>
                   


 <!-- Premiere meilleur vente -->

                <div class="row">


 <?php 

                  foreach($firsts as $first){
                echo '<div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <img src="'.'http://127.0.0.1:8000/' .$first->image .'"   height="300" width="490" class="" >

                <div class="card-body">
                  <h4 class="card-title">' .$first->name. '</h4> 
                  <h5> Prix : ' . $first->price . '€</h5>
                  <p class="card-text">' . $first->description . '</p>
                  <button class="addtocart-btn" type="submit"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>

                </div>
                
              </div>
            </div>
';
          }

?>




           </div>
          </div>
          
              <div class="col-lg-1 col-md-2 col-sm-3 bg-dark">   
              </div>


            </div>
        </div>


        <!-- 2eme container -->

        <div class="container-fluid text-center"> 
             <div class="row">

                <div class="col-lg-1 col-md-2 col-sm-3 bg-dark">
                </div>

                <div class="col-lg-10 col-md-20 col-sm-30">
                <div clas="container-fluid text-left">
                <hr>
                  <h4> Tous nos produits </h4>
                </div>
                <hr>

                
 <ul class="dropdownmenu">
            <li><a href="#">Prix</a></li>
            <li><a href="#">Vetements</a>
            <li><a href="#">Accessoires</a</li>
            <li><a href="#">Goodies</a></li>
</ul>

        <br>

          <!-- -->  


                 <div class="row">
                  <?php 

                  foreach($products as $product){
                echo '<div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <img src="'.'http://127.0.0.1:8000/' .$product->image .'"   height="300" width="490" class="" >

                <div class="card-body">
                  <h4 class="card-title">' .$product->name. '</h4> 
                  <h5> Prix : ' . $product->price . '€</h5>
                  <p class="card-text">' . $product->description . '</p>
                  <button class="addtocart-btn" type="submit"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>

                </div>
                
              </div>
            </div>
';
          }
            ?>
               
               
      </div>


 </div>
  <div class="col-lg-1 col-md-2 col-sm-3 bg-dark">
                </div>
      
</div>
</div>




    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  </body>

</html>


