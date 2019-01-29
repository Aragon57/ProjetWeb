<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <title>Laravel</title>
        <!-- Fonts -->
        
        <!-- Styles -->
        <body>
            @include('layouts/nav')
            
            <div class="container-fluid  ">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-lg-1 col-md-2 col-sm-3 ">
                            
                        </div>
                        <div class="col-lg-10 col-md-20 col-sm-30 whitos ">
                            <?php
                            foreach ($ideas as $idea) {
                            $i = 0;
                            $class='btnsearch';
                            if($idea->validate == false){
                            echo '<div>
                                <h1>'. $idea->name .'</h1>
                                <p>'.$idea->description.'</p>
                                <hr>';
                                if(isset($_SESSION['email'])){
                                foreach ($likes as $like ) {
                                if($like->id_event == $idea->id){
                                $i=$i+1;
                                }
                                if($like->id_user == $_SESSION['id'] && $like->id_event == $idea->id){
                                $class='btnsearchliked';
                                break;
                                }
                                else{
                                $class='btnsearch';
                                }
                                }
                                echo '   <form method="get" action="/voteidee/'.$idea->id.'" > '         .  csrf_field() .'
                                    <button type = "submit" class="'. $class. '" type="submit">Vote : '. $i .'</i></i> </button>
                                </form>
                                ';
                                
                                
                                
                                }
                                if(isset($_SESSION['email'])){
                                if($_SESSION['status']==4){
                                echo '   <form method="post" action="/validate" > '         .  csrf_field() .'
                                    <input type="hidden" name="id" value='. $idea->id .'  >
                                    <input type="text" name="description" placeholder="description" >
                                    <input type="date" name="date">
                                    <input type="number" min="0" name="price" placeholder="prix">
                                    <input type="hidden" name="name" value="'.  $idea->name  .'"  >
                                    <input type="hidden" name="email" value="'.  $_SESSION['email']  .'"  >
                                    <input type="hidden" name="validate" value=1  >
                                    <button type = "submit" class="btn" type="submit">Valider</i></i> </button>
                                </form>
                                ';
                                }
                                }
                                }
                                }
                                ?>
                                <hr>
                                <?php
                                if(isset($_SESSION['email'])){
                                echo    '<form action="/idee" method="post">'.
                                    csrf_field() .
                                    '<div class="input-group form-group">
                                        
                                        <input type="text" name="title" placeholder="Titre" require="required" class="form-control marge" >
                                    </div>
                                    <div class="input-group form-group">
                                        
                                        <input type="text" name="desc" placeholder="Description" require="required" class="form-control topleft descr" >
                                        
                                        <div class="input-group form-group">
                                            <input type="submit" value="Envoyer" class="btnsearch marge">
                                        </div>
                                    </div>
                                </form>';
                                }
                                ?>
                                <div class="col-lg-1 col-md-2 col-sm-3">
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                    
            @include ("footer")

                </body>
                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="{{ asset('js/bootstrap.min.js') }}"></script>
                
                <script src="{{ asset('js/script.js') }}"></script>
                
            </html>