<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <title>Laravel</title>
    
  </head>
  <body >
    <!-- Navbar -->
    @include('layouts/nav')
    <div class="container-fluid  ">
      <div class="container-fluid ">
        <div class="row">
          <div class="col-lg-1 col-md-2 col-sm-3 ">
          </div>
          <div class="col-lg-10 col-md-20 col-sm-30 whitos heit ">
            <hr>

            

            <?php
            
            if(empty($register)){
            $mess = 'S\'inscrire';
            }else{
            $mess = 'Se désinscrire';
            }
            if(isset($_SESSION['email'])){
            if($event->date >= date("Y-m-d") ){
            ?>

            <!-- Formulaire pour s'inscrire à un événement -->

            <form method="get" action="/register/{{$event->id}}" >
              <button type = "submit" class="btnsearch commentdel " >{{$mess}}</i></button>
            </form>
            @php
            }
            }
            @endphp
            <h1 class="jour"> <strong>{{ $event->name }} </strong></h1>
            <hr>
            <div class="row">
              <div class="col-lg-8 col-md-16 col-sm-24 ">
                 

                 <!-- Affichage des informations de l'événement -->

                <h2>Date : {{ $event->date }}</h2>
            
                @if(isset($event->price))
              
                <h2>Prix : {{ $event->price }} €</h2>
             
               
                @else
                @endphp
                <h2>Gratuit</h2>
                
                @endif
                
                <h5>Description : {{ $event->description }}</h5>
              </div>
              <div class="col-lg-4 col-md-8 col-sm-12">
                <img src="/storage{{$event->logo}}" alt="" class="" >
              </div>
            </div>
            <h4><U>Photo de l'événement : </U></h4>
            <div class="row">
              @foreach($images as $image)
              <div class="col-lg-12 col-md-24 sm-36 text-left"><img src="/storage{{$image['image']}}" alt="Probleme chargement"
                class="" >
                <div class="row">
                  <div class="col-lg-1 col-md-2 sm-3 text-right">
                    <form method="post" action="/likepic/{{ $image->id}}" >
                      <input type="hidden" name="id_event" value='{{$event->id}}'  >


                       <!--  -->
                      @csrf
                      @php
                      if(isset($_SESSION['id'])){
                      if ($image->liked==1){
                      $i = $image->nb-1 ;
                      if($i!=0){
                      echo'<button type = "submit" class=" like btn  " ><i class="fas fa-heart red"> Vous et ' . $i . ' aiment</i> </button>  ';
                    }
                      if($i==0){
                      echo'<button type = "submit" class=" like btn  " ><i class="fas fa-heart red"> </i> </button>  ';
                      }
                      }else{
                      echo '<button type = "submit" class=" like btn  " ><i class="fas fa-heart"></i> </button> ';
                      }
                      }
                      @endphp
                    </form>
                  </div>
                  <div class="col-lg-1 col-md-2 sm-3 text-left">
                    @if(isset($_SESSION['email']))
                    @if($_SESSION['status']==4)
                    <form method="post" action="/image/delete/{{$image->id}}" >
                      @csrf
                      <input type="hidden" name="id_event" value= {{ $event->id}}>
                      <button type = "submit" class="commentdel like btn  " ><i class="fas fa-ban"></i></button>
                    </form>
                    @endif
                    @if($_SESSION['status']==3)
                    <form method="post" action="/image/report/{{$image->id}}" >
                      @csrf
                      <input type="hidden" name="id_event" value={{$event->id}}  >
                      <button type = "submit" class="commentdel like btn  " ><i class="fas fa-exclamation-triangle"></i></button>
                    </form>
                    @endif
                    @endif
                  </div>
                  <br>
                  @foreach($comments as $comment)
                  @php
                  if($comment->id_image == $image->id){
                  @endphp
                </div>
                <div class="row">
                  <div class="col-lg-10 col-md-20 sm-30 text-left">
                    {{$comment->content}}
                  </div>
                  @php
                  if(isset($_SESSION['email'])){
                  if($_SESSION['status']==4){
                  @endphp
                  
                  <div class="col-lg-2 col-md-4 sm-6 text-left">
                    <form method="post" action="/comment/delete" >
                      @csrf
                      <input type="hidden" name="id_event" value='{{$event->id}}'  >
                      <input type="hidden" name="id_image" value= {{$image->id }}  >
                      <input type="hidden" name="id_com" value={{$comment->id}}  >
                      <button type = "submit" class="commentdel like btn  " ><i class="fas fa-ban"></i></button>
                    </form>
                  </div>
                  
                  @php
                  }
                  @endphp
                  @php
                  if($_SESSION['status']==3){
                  @endphp
                  <div class="col-lg-2 col-md-4 sm-6 text-left">
                    <form method="post" action="/comment/report/{{$comment->id}}" >
                      @csrf
                      <input type="hidden" name="id_event" value={{$event->id}}  >
                      <button type = "submit" class="commentdel like btn  " ><i class="fas fa-exclamation-triangle"></i></button>
                    </form>
                  </div>
                  
                  @php
                  }
                  }
                  @endphp
                  
                  @php
                  }
                  @endphp
                  @endforeach
                  
                </div>
                
                <form class="com" action="/commentImage" method="post">
                  @csrf
                  <input name="id_image" type="hidden" value={{$image->id}} >
                  @php
                  if(isset($_SESSION['id'])){
                  @endphp
                  <input type="text"  name="comment" placeholder="Commentaire" class="" required>
                  <input type="hidden" name="id_event" value='{{$event->id}}'  >
                  <input type="submit" value="Envoyer" class="btnsearch marge">
                  @php
                  }
                  @endphp
                </form>
                <hr>
              </div>
              @endforeach
              @php
              if(isset($_SESSION['email'])){
              if((isset($register)) || $_SESSION['status']==4){
              if($event->date  < date("Y-m-d") ){
              @endphp
            </div>
            <hr>
            <h5> Vous pouvez ajouter des photos :  </h5>
            <form method="post" action="/add/image/{{$event->id}}" enctype= "multipart/form-data">
              @csrf
              <input type="hidden" name="id_event" value='{{$event->id}}'  >
              <input type="file" name="userfile" required><br>
              <input type="hidden" name="id_event" value={{$event->id}}  ><input type="submit" value="OK">
            </form>
            @php
            }
            }
            @endphp
            <hr>
            @php
            if(isset($_SESSION['email'])){
            if($_SESSION['status']==4){
            @endphp
            <form method="get" action="/generate-pdf/{{$event->id}}" >
              <button type = "submit" class="btnregist " >Récupérer les élèves inscrits</button>
            </form>
            @php
            }
            }
            }
            @endphp
          </div>
          <div class="col-lg-1 col-md-2 col-sm-3 ">
          </div>
        </div>
      </div>
      @php
      if(!isset($_SESSION['email'])){
      @endphp
    </div>
    @php
    }
    @endphp
  </div>
  @include('footer')
</body>
</html>