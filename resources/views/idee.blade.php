<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
        <title>Laravel</title>
        <!-- Fonts -->
      
        <!-- Styles -->
    <body style ="background-color:#1d2124">
        @include('layouts/nav')
     




   <div class="container-fluid  "> 
        <div class="container-fluid "> 
            <div class="row">
                <div class="col-lg-1 col-md-2 col-sm-3 ">
                    
                </div>
                <div class="col-lg-10 col-md-20 col-sm-30 whitos ">

<?php

foreach ($ideas as $idea) {

    if($idea->validate == false){

    echo '<div>
            <h1>'. $idea->name .'</h1>
            <p>'.$idea->description.'</p>
            <hr>';

            foreach ($eventregisters as $eventregister) {
                                            if($eventregister->id_user == $_SESSION['id'] && $eventregister->id_event == $idea->id){
                                                    $class= 'btn btnsearchliked';                                            

                                 }
                                 else{
                                                                                    
                                            $class= 'btn btnsearch';
                                 }
                             echo '   <form method="post" action="/eventregister" > '         .  csrf_field() .'

                                    <input type="hidden" name="id_event" value='. $idea->id .'  >

                                    
                                    <button type = "submit" class="' . $class  . '" type="submit">' . 'Vote : </i></i> </button>
                                    </form>
                                    ';
            }
             

            
echo '<input type="checkbox" id="showpopup"/>
        <label for="showpopup">Cliquer ici pour afficher ou cacher le formulaire</label>
        <div id="popup">
            <form method="PUT" action="/idee/'.$idea->id .'" >
                <input type="date" name="date" placeholder="date"/><br/>
                <input type="text" name="description" placeholder="Modifier description"/><br/>
                 <SELECT class="form-control" name="punctuality" size="1">
                                <OPTION>Récurent 
                                <OPTION>Ponctuelle

                                </SELECT><br/>
                <input type="hidden" name="validate" value = "1"/><br/>

                <input type="submit" name="register" value="Je m\'inscris"/></form><br/>
            </form>
        </div>';

    }
}
?>
<?php 
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
                </div>'; 





?>
                <div class="col-lg-1 col-md-2 col-sm-3">
                   
                 
                    </div>




                </div>
            </div>
        </div>


    </body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        
       <script src="{{ asset('js/script.js') }}"></script>


    

</html>
