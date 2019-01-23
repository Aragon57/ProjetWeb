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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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


  <div>
    <h4 id="searchtitle" align="left" >Recherchez un article </h4>

        <div class="recherche_p">
          <form class="searchbox" action="/search" method="get">
            <input type="text" placeholder="" name="q">
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
  </div>


 <div class="w3-container">
  <div align="left">
  <button onclick="document.getElementById('id01').style.display='block'" id="addarticles-btn">Ajouter un article</button>
  </div>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:3000px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" action="/article" method="post" enctype="multipart/form-data" >
                            {{ csrf_field() }}

        <div class="w3-section">

          <label><b>Nom de l'article</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" name="name" required>

          <label><b>Description de l'article</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" name="description" required>

          <label><b>Prix de l'article</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="float" placeholder="" name="price" required>

          <label><b>Nombre d'articles en stock</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="integer" placeholder="" name="stock" required>
          <input type="hidden" name="MAX_FILE_SIZE" value="100000">


          <label><b>Type de l'article</b></label>
           <select class="form-control" name="category" size="1">
             <option>Vêtements 
             <option>Goodies
             <option>Accessoires                    
           </select> <br>

          <label><b>Ajouter une image ?</b></label><br>
          <input class="w3-input w3-border w3-margin-bottom" type="hidden" name="MAX_FILE_SIZE" value="100000"> Envoyez ce fichier: <input name="userfile" type="file" />
          <br><br>

          <button id="ok-btn" type="submit">Confirmer</button>

        </div>
      </form>

    </div>
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

      foreach ($firsts as $first) {
        echo '<div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100">

        <img src="' . 'http://127.0.0.1:8000/' . $first->image . '"   height="60%/9" width="100%/9" class="" >

        <div class="">
        <h4 class="card-title">' . $first->name . '</h4> 
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

    <!-- Filter box -->

    <br>
    <div class="col-lg-12 col-md-24 col-sm-36" >
      <h4 id="filteredproducts" align="left" > &nbsp;&nbsp;<i class="fas fa-filter fa-1x"></i><span></span> Triez par : </h4>


      <div class="recherche_p">
        <div id="filteredproducts" align="left">

         <ul class="dropdownmenu">
          
          <li><a href="">Prix</a>
            <li><a href="#">Nom</a>
              <li><a href="#">Vêtements</a>
                <li><a href="#">Accessoires</a>
                  <li><a href="#">Goodies</a>
                  </ul>
                </div>
              </div>
            </div>

            <br>


            <!--------------->

            <br>

            <div class="row">
              <?php 

              foreach ($products as $product) {
                echo '<div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                <input type="hidden" class="id" name="id" value="'.$product->id.'">
                <img src="' . 'http://127.0.0.1:8000/' . $product->image . '"   height="60%/9" width="100%/9" class="" >

                <div class="">
                <h4 class="card-title">' . $product->name . '</h4> 
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
  <script>
    $(document).ready(()=>{
      $('addtocart-btn').click(()=>{
        let send_data = $('input[name=id]');
        $.post('', send_data, (data, status)=>{
          console.log(data);
          console.log(status);
        });
      });
    });
  </script>  
</html>


