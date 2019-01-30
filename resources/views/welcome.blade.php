<?php session_start() ?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href= "{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href= "{{ asset('css/style.css') }}" rel="stylesheet">
        <link href= "{{ asset('css/footer.css') }}" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <title>Laravel</title>
        <!-- Fonts -->
        
        <!-- Styles -->
        <body>
            @include('layouts/nav')
            
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
                                        <img  class="img-carousel-welcome" src="https://images.pexels.com/photos/976866/pexels-photo-976866.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" alt="First slide">
                                        <div class="carousel-caption text-right black">
                                            
                                            <h1><B>Les meilleurs évènements d'Alsace.</B></h1>
                                            <p><B>Le BDE propose chaque semaine de nombreux évènements, tous plus fous les uns que les autres !</B></p>
                                            <br>
                                            <br>
                                            <p><a class="btn btn-lg btn-primary" href="/event" role="button">Accéder</a></p>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-carousel-welcome" src="https://www.kelcible.fr/wp-content/uploads/boutique-en-ligne.jpg" alt="Second slide">
                                        <div class="carousel-caption text-right black">
                                            <h1><B>Boutique en ligne</B></h1>
                                            <p><B>Le BDE propose une nouvelle boutique en ligne. Vous y trouverez de nombreux goodies, accessoires ou encore des vêtements !</B></p>
                                            <br>
                                            <br>
                                            <p><a class="btn btn-lg btn-primary" href="/boutique" role="button">Accéder</a></p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-carousel-welcome" src="http://chartreuse-liege.be/wp-content/uploads/2017/12/idee.jpg" alt="Third slide">
                                        <div class="carousel-caption text-right black">
                                            <h1><B>Proposez vos idées.</B></h1>
                                            <p><B>Le BDE est à votre écoute, proposez vos idées d'évènements afin de peut-etre les voir se réaliser !</B></p>
                                            <br>
                                            <br>
                                            <p><a class="btn btn-lg btn-primary" href="/idee" role="button">Accéder</a></p>
                                        </div>
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
                            
                            
                            
                        

                               <div class="col-lg-12 col-md-24 col-sm-36 whitos heit">
              <br>

            <h1> Evénements du jour </h1>
            <hr>
              <!-- Foreach afin d'aficher l'ensemble des événements créé -->
              @foreach($events as $event)
              <a class ="lien" href="/event/{{$event->id}}">
                <div class="blackos" >
                  <div class="row">
                    <div class="col-lg-8 col-md-16 col-sm-24 text-left">

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
              
        
            
           
                </div>
            </div>
                        <div class="col-lg-1 col-md-2 col-sm-3">
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            @include('footer')
            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            @include('modal')
        </body>
        
    </html>