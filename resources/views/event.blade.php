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





                        echo ' <h1 align="center">Evenements du jour </h1>';


                        foreach ($events as $event) {

                            if($event->validate == true){


                                if($event->date == date("Y-m-d")){

                                    echo '<div class="boite">
                                    <h1>Evénement : '. $event->name .'</h1>
                                    <hr>
                                    <h6>Date de l\'événement : '. $event->date .  '&nbsp &nbsp &nbsp &nbsp' . 'Prix : ' . $event->price .'€</h6>

                                    <p>Description : '.$event->description.'</p>
                                    ';

                                    if(isset($_SESSION['email'])){

                                        $mess="S'enregistrer";

                                        foreach ($eventregisters as $eventregister ) {
                                            if($eventregister->id_user == $_SESSION['id'] && $eventregister->id_event == $event->id){
                                                                                          $mess='Se désinscrire';      

                                 }
                                 else{
                                                                              $mess='S\'enregistrer';      

                                 }
                             }

                                   echo '   <form method="post" action="/eventregister" > '         .  csrf_field() .'

                                     <input type="hidden" name="id_event" value='. $event->id .'  >

                                    
                                    <button type = "submit" class="  " type="submit">' . $mess.'</i></i> </button>
                                    </form>
                                    ';

                                            
                                        

                                    
                                    }




                                    ;
                                    echo '<div class="row">';

                                    foreach($img as $image){


                                        if($image['id_event']==$event['id']){

                                            echo ' <div class="col-lg-5 col-md-10 sm-15"><img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" ></div>';
                                        }
                                    }


                                    

                                    echo '</div>                               
                                    <form method="post" action="/like" > '         .  csrf_field() .'

                                     <input type="hidden" name="id_event" value='. $event->id .'  >

                                    
                                    <button type = "submit" class=" like btn  " type="submit"><i class="fas fa-heart"></i></i> </button>
                                    </form>
                                    ';
                                



                                    echo '

                                    <form method="post" action="/image" enctype= "multipart/form-data"> '.  csrf_field() .


                                    '<input type="file" name="fichier" required><br>

                                    <input type="hidden" name="id_event" value='. $event->id .'  ><input type="submit" value="OK">

                                    
                                    </form>
                                 
                                <hr>
                                <h6> <b> Commentaires :  </b></h6> <hr>';


                                    foreach($comments as $comment){

                                        if($comment->id_event == $event->id)


                                            echo '<p>'. $comment->content .'</p> <hr>';

                                   

                                    }



                                    if(isset($_SESSION['email'])){

                                     echo    '<form action="/comment" method="post">'.
                                     csrf_field() .

                                     '<div class="input-group form-group">

                                     <input type="text" id="comment" name="comment" placeholder="Commentaire" class="form-control marge" required>
                                     <input id="id_event" name="id_event" type="hidden" value="'.$event->id .'" required>
                                     <input id="id_user" name="id_user" type="hidden" value="'.$_SESSION['id'].'" required>
                                   

                                     <input type="submit" value="Envoyer" class="btnsearch marge">
                                       </div>
                                     </form>
                                     ';


                                 }
                                 echo '</div> <hr>';

                             }

                         }
                     }

                     echo '<h1 align="center">Evenements à venir </h1>';




                     foreach ($events as $event) {


                        if($event->validate == 1){


                            if($event->date > date("Y-m-d")){
                                echo '<div>
                                <h1>'. $event->name .'</h1>

                                <h6>'. $event->date .  '&nbsp &nbsp' . 'Prix : ' . $event->price .'</h6>

                                <p>'.$event->description.'</p>
                                ';


                                if(isset($_SESSION['email'])){
                                    echo '<div><input class="favorite styled" type="button" value="S\'inscire"> </div>';
                                }

                                foreach($img as $image){


                                    if($image['id_event']==$event['id']){
                                        echo '<img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" width="20%/9" height="20%/9">';
                                    }
                                }
   echo '<div>

                                    <form method="post" action="/image" enctype= "multipart/form-data"> '.  csrf_field() .


                                    '<input type="file" name="fichier" required><br>

                                    <input type="hidden" name="id_event" value='. $event->id .'  >

                                    <input type="submit" value="OK">
                                    </form>
                                    </div> ';


                                foreach($comments as $comment){

                                    if($comment->id_event == $event->id)
                                        echo '<p>'. $comment->content .'</p>';

                                }



                                if(isset($_SESSION['email'])){

                                  echo    '<form action="/comment" method="post">'.
                                     csrf_field() .

                                     '<div class="input-group form-group">

                                     <input type="text" id="comment" name="comment" placeholder="Commentaire" class="form-control marge" required>
                                     <input id="id_event" name="id_event" type="hidden" value="'.$event->id .'" required>
                                     <input id="id_user" name="id_user" type="hidden" value="'.$_SESSION['id'].'" required>
                                   

                                     <input type="submit" value="Envoyer" class="btnsearch marge">
                                       </div>
                                     </form>
                                     ';
                             }

                             echo '<hr>';
                         }
                     }
                 }



                 echo  '<h1 align="center"> Evenements passés </h1>';




                 foreach ($events as $event) {

                    if($event->validate == true){

                        if($event->date < date("Y-m-d")){


                            echo '<div>
                            <h1>'. $event->name .'</h1>

                            <h6>'. $event->date .  '&nbsp &nbsp' . 'Prix : ' . $event->price .'</h6>

                            <p>'.$event->description.'</p>
                            ';




                            if(isset($_SESSION['email'])){
                                echo '<div><input class="favorite styled" type="button" value="S\'inscire"></div>';
                            }

                            foreach($img as $image){


                                if($image['id_event']==$event['id']){
                                    echo '<img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" width="20%/9" height="20%/9">';
                                }
                            }


    echo '<div>

                                    <form method="post" action="/image" enctype= "multipart/form-data"> '.  csrf_field() .


                                    '<input type="file" name="fichier" required><br>

                                    <input type="hidden" name="id_event" value='. $event->id .'  >

                                    <input type="submit" value="OK">
                                    </form>
                                    </div> ';


                                    foreach($comments as $comment){

                                    if($comment->id_event == $event->id)
                                        echo '<p>'. $comment->content .'</p>';

                                }


                            if(isset($_SESSION['email'])){

                             echo    '<form action="/comment" method="post">'.
                                     csrf_field() .

                                     '<div class="input-group form-group">

                                     <input type="text" id="comment" name="comment" placeholder="Commentaire" class="form-control marge" required>
                                     <input id="id_event" name="id_event" type="hidden" value="'.$event->id .'" required>
                                     <input id="id_user" name="id_user" type="hidden" value="'.$_SESSION['id'].'" required>
                                   

                                     <input type="submit" value="Envoyer" class="btnsearch marge">
                                       </div>
                                     </form>
                                     ';




                         }
                         echo '<hr>';

                     }
                 }

             }?>

             <?php 

             if(isset($_SESSION['email'])){

                
                    echo    '<form action="/event" method="post">'.
                    csrf_field() .

                    '<div class="input-group form-group">

                    <input type="text" name="title_manif" placeholder="Titre"  class="form-control marge" required>

                    </div>
                    <div class="input-group form-group">

                    <input type="date" name="date_manif" placeholder="Date"  class="form-control marge" required>

                    </div>
                    <div class="input-group form-group">

                    <input type="float" name="price_manif" placeholder="Prix"  class="form-control marge" required>

                    </div>
                    <div class="input-group form-group">

                    <SELECT class="form-control" name="punctuality" size="1" required>
                    <OPTION>Récurent 
                    <OPTION>Ponctuelle

                    </SELECT>
                    </div>
                    <div class="input-group form-group">

                    <input type="text" name="desc_manif" placeholder="Description"  class="form-control descr" required>


                    <div class="input-group form-group">
                    <input type="submit" value="Envoyer" class="btnsearch marge">
                    </div>
                    </div>'; 
                }else{

                }
            
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
</html>
