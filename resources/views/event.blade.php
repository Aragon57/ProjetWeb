<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <title>Laravel</title>
   
    <body >
      @include('layouts/nav')
      <div class="container-fluid  ">
        <div class="container-fluid ">
          <div class="row">
            <div class="col-lg-1 col-md-2 col-sm-3 ">
            </div>
            <div class="col-lg-10 col-md-20 col-sm-30 whitos heit">
              <br>


              <!-- Foreach afin d'aficher l'ensemble des événements créé -->
              @foreach($events as $event)
              <a class ="lien" href="/event{{$event->id}}">
                <div class="div1 lien" >
                  <div class="row">
                    <div class="col-lg-8 col-md-16 col-sm-24 ">

                      <!-- Afficher les informations pour chaque événement -->
                      <h1 > <strong>{{ $event->name }} </strong></h1>
                      
                      <h2>Date : {{ $event->date }}</h2>

                      <!-- Afficher le prix ou la gratuité -->
                      @if((!isset($event->price))|| $event->price == 0)
                      
                      <h2>Gratuit</h2>
                        
                                         
        
                        @else

                      <h2>Prix : {{ $event->price }} €</h2>
                          
                      @endif                     
                      
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12 ">
                      <img src="/storage/{{$event->logo}}" height ="200" width="300" alt="">
                    </div>
                  </div>
                </div>
              </a>
              <br>
              @endforeach
              
              @if(isset($_SESSION['email']))
             
              @if($_SESSION['status'] >= 3)
              
              <!-- Bouton pour télécharger les photos des événements -->

              <form id="dlimages" method="get" action="/dlfile" >
                <button type ="submit" class="btnregist " >Télécharger les photos des événements></button>
              </form>
              @endif
            
              
              <!-- Formulaire poour créer un événement en tant que membre du BDE -->

              @if($_SESSION['status'] == 4)
              <form id="addevent" action="/event" method="post" enctype="multipart/form-data">
                @csrf
                <div class="input-group form-group">
                  <input type="text" name="title_manif" placeholder="Titre"  class="form-control marge" required>
                </div>
                <div class="input-group form-group">
                  <input type="date" name="date_manif"   class="form-control marge" required>
                </div>
                <div class="input-group form-group">
                  <input type="number" step="0.01" name="price_manif" placeholder="Prix"  class="form-control marge" required>
                </div>
                <div class="input-group form-group">
                  <SELECT class="form-control" name="punctuality" size="1">
                    <OPTION>Récurent
                      <OPTION>Ponctuelle
                      </SELECT>
                    </div>
                    <div class="input-group form-group">
                      <input type="text" name="desc_manif" placeholder="Description"  class="form-control descr" required>
                    </div>
                    <input type="file" name="userfile" ><br>
                    
                    <div class="input-group form-group">
                      <input type="submit" value="Envoyer" class="btnsearch marge">
                    </div>
                  </form>
                  @endif
                 @endif
                  <div class="col-lg-1 col-md-2 col-sm-3">
                  </div>
                </div>
              </div>
            </div>
          </div>

          @include('footer')
          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        
 <script>
         // $(document).ready(()=>{
         //   $('#addevent').submit((event)=>{
         //      event.preventDefault();

         //     let data = $('#addevent');

         //      $.post('/event', data.serialize(), (data, status)=>{
         //        document.location.href="/event";
         //      });
         //    });
         //  });
        </script>
        </body>
       
      </html>