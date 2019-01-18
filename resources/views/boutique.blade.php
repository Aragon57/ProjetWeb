<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boutique BDE Strasbourg</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boutique.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    
  </head>



  <body>

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
                
                <div class="container-fluid text-center">        
                <div class="row">

                  <div class="col-lg-12 col-md-24 col-sm-36" > 
                  <h4> Recherchez un article </h4>

                  <div class="recherche_p">
                   <form action="/search" id="searchthis" method="get">
                    <input id="search" name="q" type="text" placeholder="" />
                    <input id="search-btn" type="submit" value="Rechercher" />
                   </form>
                   </div>
                   </div>

                  
                 </div>
               </div>
               <br> 

 <!-- Premiere meilleur vente -->

                <div class="row">

               <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/tshirt2.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4> 
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>

                </div>
                
              </div>
            </div>

 <!-- Deuxieme meilleur vente -->

               <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/tshirt1.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

        <!-- Troisieme meilleur vente -->

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/tshirt3.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

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



                 <div class="row">

                <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/tshirt1.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

               <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/tshirt2.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

               <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/tshirt3.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

              <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/sac.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

               <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/mug.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

               <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100">

                <a href=""> <img class="card-img-top" src="{{ asset('/img/boutique/peluche.png') }}" alt=""> </a>

                <div class="card-body">
                  <h4 class="card-title"> <a href=""> Item One</a> </h4>
                  <h5>Prix: 24.99</h5>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                  <button class="addtocart-btn" type="button"> Ajouter au panier <span> </span> <i class="fas fa-shopping-cart"> </i></button>
                </div>
                
              </div>
            </div>

              </div>
           </div>

                <div class="col-lg-1 col-md-2 col-sm-3 bg-dark">
                </div>
      </div>
 </div>



  

    <!-- Bootstrap core JavaScript -->

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

  </body>

</html>


