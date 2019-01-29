@php
session_start();
@endphp

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
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('fontawesome/css/style.css') }}" rel="stylesheet">
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('/js/boutique.js') }}"></script>
</head>
<body>
  
  <!-- Barre de navigation -->
  @include('layouts/nav')

  <!-- Premier container -->
  <!-- Inclusion de la fonction de articlecard -->
  @include('components/articlecard')

  <div class="container-fluid text-center">
    <div class="row">
      <div class="col-lg-1 col-md-2 col-sm-3 "></div>

      <!-- Titre principale -->
      <div class="col-lg-10 col-md-20 col-sm-30">
        <hr class="hrshop">
        <h2>Bienvenue sur notre boutique</h2>
        <hr class="hrshop">
        <br>

        <!-- Ajouter un article dans la boutique -->
        @if(isset($_SESSION['email']))
        @if($_SESSION['status']==4)
        <div class="w3-container">
          <div class="gauche">
            <button onclick="document.getElementById('id01').style.display='block'" class="addarticles-btn">Ajouter un article</button>
          </div>
          <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:3000px">
              <div class="w3-center"><br>
                <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
              </div>
              <form class="w3-container" action="/article" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="w3-section">
                  <label><b>Nom de l'article</b></label>
                  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" name="name" required>
                  <label><b>Description de l'article</b></label>
                  <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" name="description" required>
                  <label><b>Prix de l'article</b></label>
                  <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="" name="price" required>
                  <label><b>Nombre d'articles en stock</b></label>
                  <input class="w3-input w3-border w3-margin-bottom" type="number" placeholder="" name="stock" required>
                  <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                  <label><b>Type de l'article</b></label>
                  <select class="form-control" name="category" size="1">
                    @foreach($categories as $category)
                    <option> {{ $category->name }}
                      @endforeach
                    </select> <br>
                    <label><b>Ajouter une image ?</b></label><br>
                    <input class="w3-input w3-border w3-margin-bottom" type="hidden" name="MAX_FILE_SIZE" value="100000"> Envoyez ce fichier: <input name="userfile" type="file" />
                    <br><br>
                    <button class="ok-btn" type="submit">Confirmer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          
          
          <!-- Ajouter une categorie -->
          <div class="w3-container">
            <div class="gauche">
              <button onclick="document.getElementById('id02').style.display='block'" class="addarticles-btn">Ajouter une catégorie</button>
            </div>


            <div id="id02" class="w3-modal">
              <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:3000px">
                <div class="w3-center"><br>
                  <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <form class="w3-container" action="/category" method="post" enctype="multipart/form-data" >
                  @csrf
                  <div class="w3-section">
                    <label><b>Nom de la catégorie</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Catégorie" name="category" required>
                    <button class="ok-btn" type="submit">Confirmer</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          @endif
          @endif

          <!-- Trois articles les plus vendus -->
          <br><hr class="hrshop">
          <div class="col-lg-12 col-md-24 col-sm-36">
            <h4> Nos meilleures ventes</h4>
          </div>
          <hr class="hrshop"><br>

          <!-- Chargement de la card des trois articles les plus vendus -->
          <div class="row">
            @foreach ($firsts as $first)
            <div class="card-deck col-lg-4 col-md-6 mb-4 rezize-div">
              @php loadcard($first, false) @endphp
            </div>
            @endforeach
          </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-3 ">
        </div>
      </div>
    </div>
    
    
    <!-- Debut du second container contenant tout les produits de la boutique -->
    <div class="container-fluid text-center">
      <div class="row">
        <div class="col-lg-1 col-md-2 col-sm-3 "></div>
        <div class="col-lg-10 col-md-20 col-sm-30 ">
          <hr class="hrshop">
          <div class="container-fluid text-left">
            
            <h4> Tous nos produits </h4>
          </div>
          <hr class="hrshop">

          <!-- Barre du Filtre par prix et categories -->
          <br>
          <div class="col-lg-12 col-md-24 col-sm-36" >
            <h4 class="filteredproducts gauche" > &nbsp;&nbsp;<i class="fas fa-filter fa-1x"></i><span></span> Triez par : </h4>
            
            <div class="recherche_bar">
              <div class="filteredproducts gauche">
                <ul class="dropdownmenu">
                  <li><button id="tri-prix" class="btn btn-light classer" value="Prix"> Prix </button></li>
                  @foreach($categories as $category)
                  <li><button class="btn btn-light tri" value={{$category->id}} > {{$category->name}} </button></li>
                  @endforeach
                </ul >
              </div>
            </div>
          </div>

          <!-- Barre de recherche -->
          <div>
            <h4 id="dcal" >Recherchez un article </h4>
            
            <form autocomplete="off" action="/search" method="POST">
              @csrf
              <div class="autocomplete" style="width:300px;">
                <input id="myInput" type="text" name="search" placeholder="Recherche">
              </div>
              <button value="search" type="submit"> Rechercher </button>
            </form>
          </div>
          <br>

          <!-- Code permettant de supprimer les accents sur les lettres pour éviter toute erreur dans les filtres -->
          <div id="sdq" class="row">
            @foreach ($products as $product)
            @php
            $cate = $product['id_category'];
            
            $caract_interdit = array(
            'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', ' ' => ''
            );
            
            $cate = strtr($cate, $caract_interdit);
            $cate = strtolower($cate);
            @endphp

            <!-- Chargement des articles en fonction de la categories -->
            <div  class="card-deck col-lg-4 col-md-6 mb-4 article {{ $cate }} rezize-div">
              @php loadcard($product, true); @endphp
            </div>

            <!-- Ajouter des articles au panier -->
            <div class="w3-container" style="padding: 0;">
              <div id="product{{ $product->id }}" class="w3-modal">
                <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:3000px">
                  <div class="w3-center"><br>
                    <span onclick="document.getElementById('product{{ $product->id }}').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                  </div>
                  
                  @if(isset($_SESSION['id']))
                  <form id="addtocart{{ $product->id }}" class="w3-container" action="/tocart" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="w3-section">
                      <input class="w3-input w3-border w3-margin-bottom" type="hidden" name="id_product" value={{ $product->id }}>
                      <input class="w3-input w3-border w3-margin-bottom" type="hidden" name="id_user" value={{ $_SESSION['id'] }}>
                      <input class="w3-input w3-border w3-margin-bottom" type="integer" name="quantity" value="1" required>
                      
                      <button id="ok-btn" type="submit">Confirmer</button>
                    </div>
                  </form>
                  @endif
                </div>
              </div>
            </div>

            <!-- Script pour ajouter au panier les articles -->
            <script>
              $(document).ready(()=>{
                $('#addtocart{{ $product->id }}').submit((event)=>{
                  event.preventDefault();
                  
                  let form = $('#addtocart{{ $product->id }}');
                  
                  $.ajax({
                    type : 'POST',
                    url : '/tocart',
                    data : form.serialize(),
                    dataType : 'text',
                    encode : true,
                    success : (data) => {
                      console.log("true");
                      console.log(data);
                    },
                    error : (data) => {
                      console.log("false");
                      console.log(data);
                    }
                  });
                });
              });
            </script>
            @endforeach
          </div>
        </div>
        <div class="col-lg-1 col-md-2 col-sm-3 "></div>
      </div>
    </div>

    <!-- Footer -->
    @include('footer')

    <!-- Script pour ajouter au panier les meilleurs articles -->
    <script>
      @if(isset($_SESSION['id']))
      $(document).ready(()=>{
        $('#{{ $_SESSION['id'] }}').submit((event)=>{
          event.preventDefault();
          
          let form = {
            'id_user' : "{{ $_SESSION['id'] }}",
            'id_product' : $('input[name=id]').val(),
            'id_command' : 0,
            'quantity' : 1
          }
          
          $.ajax({
            type : 'POST',
            url : 'tocart',
            data : form,
            dataType : 'text',
            encode : true,
            success : (data) => {
              console.log(data);
            },
            error : (data) => {
              console.log(data);
            }
          });
        });
      });
      @endif
    </script>

    <!-- Script pour le tri par prix -->
    <script>
      $(document).ready(()=>{
        $("#tri-prix").click(()=>{
          if($('#sdq').hasClass('checked'))
          {
            $('#sdq').load("/articlenon");
            $('#sdq').removeClass("checked");
          }
          else
          {
            $('#sdq').load("/article");
            $('#sdq').addClass("checked");
          }
        });
      });
    </script>

    <!-- Script pour la barre de recherche -->
    <script>
      autocomplete(document.getElementById("myInput"), items);
    </script>
    
  </body>

  </html>