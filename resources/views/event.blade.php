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
    <body >
        @include('layouts/nav')






        <div class="container-fluid  "> 
            <div class="container-fluid "> 
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-3 ">

                    </div>
                    <div class="col-lg-10 col-md-20 col-sm-30 whitos ">


                        <?php





                        echo ' <h1 class="jour">Evenements du jour </h1>';


                        foreach ($events as $event) {
                            $mess='S\'inscire';
                            $heart="fas fa-heart";
                            $messlike='';

                            $i =-1;
                            if($event->validate == true){


                                if($event->date == date("Y-m-d")){

                                    echo '<div class="boite">
                                    <h1>Evénement : '. $event->name .'</h1>
                                    <hr>
                                    <h6>Date de l\'événement : '. $event->date .  '&nbsp;&nbsp;&nbsp;&nbsp; ' . 'Prix : ' . $event->price .'€</h6>

                                    <p>Description : '.$event->description.'</p>
                                    ';

                                    if(isset($_SESSION['email'])){


                                        foreach ($subscribes as $subscribe ) {

                                            if($subscribe->id_user == $_SESSION['id'] && $subscribe->id_event == $event->id){
                                              $mess='Se désinscrire';     
                                              break; 

                                          }
                                          else{
                                              $mess='S\'enregistrer';      

                                          }
                                      }

                                      echo '   <form method="post" action="/like" > '         .  csrf_field() .'

                                      <input type="hidden" name="id_event" value='. $event->id .'  >
                                      <input type="hidden" name="type" value="3" >
                                      <input type="hidden" name="page" value="/event"  >

                                      <button type ="submit" class="" >' . $mess.' </button>
                                      </form>
                                      ';





                                  }




                                  ;
                                  echo '<div class="row">';

                                  foreach($img as $image){


                                    if($image['id_event']==$event['id']){

                                        echo ' <div class="col-lg-5 col-md-10 sm-15"><img src="'.'http://127.0.0.1:8000' .$image['image'] .' alt="Probleme chargement" class="" ></div>';
                                    }
                                }





                                foreach ($likes as $like ) {
                                    if($like->id_event == $event->id){
                                        $i=$i+1;
                                    }
                                    if($like->id_user == $_SESSION['id'] && $like->id_event == $event->id){
                                      $heart="fas fa-heart red";
                                      if ($i==0){
                                        $messlike='';
                                    } else{                                                                                          $messlike ="      Vous et " .$i. " personne(s) ont liké";
                                }   
                                break; 

                            }
                            else{
                              $heart="fas fa-heart";      
                              $messlike='';
                          }
                      }


                      echo '</div>                               
                      <form method="post" action="/like" > '         .  csrf_field() .'
                      <input type="hidden" name="page" value="/event"  >
                      <input type="hidden" name="type" value=1 >
                      <input type="hidden" name="id_event" value='. $event->id .'  >


                      <button type = "submit" class=" like bt "><i class="'. $heart.'">' . $messlike. '</i> </button>
                      </form>
                      ';




                      echo '

                      <form method="post" action="/image" enctype= "multipart/form-data"> '.  csrf_field() .


                      '<input type="file" name="userfile" required><br>

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

                       <input type="text"  name="comment" placeholder="Commentaire" class="form-control marge" required>
                       <input name="id_event" type="hidden" value="'.$event->id .'">
                       <input name="id_user" type="hidden" value="'.$_SESSION['id'].'">
                       <input type="submit" value="Envoyer" class="btnsearch marge">
                       </div>
                       </form>
                       ';


                   }
                   echo '</div> <hr>';

               }

           }
       }

       echo '<h1 class="jour">Evenements à venir </h1>';





                        foreach ($events as $event) {
                            $mess='S\'inscire';
                            $heart="fas fa-heart";
                            $messlike='';

                            $i =-1;
                            if($event->validate == true){


                                if($event->date > date("Y-m-d")){

                                    echo '<div class="boite">
                                    <h1>Evénement : '. $event->name .'</h1>
                                    <hr>
                                    <h6>Date de l\'événement : '. $event->date .  '&nbsp;&nbsp;&nbsp;&nbsp; ' . 'Prix : ' . $event->price .'€</h6>

                                    <p>Description : '.$event->description.'</p>
                                    ';

                                    if(isset($_SESSION['email'])){


                                        foreach ($subscribes as $subscribe ) {

                                            if($subscribe->id_user == $_SESSION['id'] && $subscribe->id_event == $event->id){
                                              $mess='Se désinscrire';     
                                              break; 

                                          }
                                          else{
                                              $mess='S\'enregistrer';      

                                          }
                                      }

                                      echo '   <form method="post" action="/like" > '         .  csrf_field() .'

                                      <input type="hidden" name="id_event" value='. $event->id .'  >
                                      <input type="hidden" name="type" value="3" >
                                      <input type="hidden" name="page" value="/event"  >

                                      <button type = "submit" class="  ">' . $mess.' </button>
                                      </form>
                                      ';

                                      
                                      

                                      
                                  }




                                  ;
                                  echo '<div class="row">';

                                  foreach($img as $image){


                                    if($image['id_event']==$event['id']){

                                        echo ' <div class="col-lg-5 col-md-10 sm-15"><img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" alt="Probleme chargement"></div>';
                                    }
                                }


                                


                                foreach ($likes as $like ) {
                                    if($like->id_event == $event->id){
                                        $i=$i+1;
                                    }
                                    if($like->id_user == $_SESSION['id'] && $like->id_event == $event->id){
                                      $heart="fas fa-heart red";
                                      if ($i==0){
                                        $messlike='';
                                    } else{                                                                                          $messlike ="      Vous et " .$i. " personne(s) ont liké";
                                }   
                                break; 

                            }
                            else{
                              $heart="fas fa-heart";      
                              $messlike='';
                          }
                      }


                      echo '</div>                               
                      <form method="post" action="/like" > '         .  csrf_field() .'
                      <input type="hidden" name="page" value="/event"  >
                      <input type="hidden" name="type" value=1 >
                      <input type="hidden" name="id_event" value='. $event->id .'  >

                      
                      <button type = "submit" class=" like btn  " type="submit"><i class="'. $heart.'">' . $messlike. '</i></i> </button>
                      </form>
                      ';
                      



                      echo '

                      <form method="post" action="/image" enctype= "multipart/form-data"> '.  csrf_field() .


                      '<input type="file" name="userfile" required><br>

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

                       <input type="text" name="comment" placeholder="Commentaire" class="form-control marge" required>
                       <input name="id_event" type="hidden" value="'.$event->id .'" >
                       <input name="id_user" type="hidden" value="'.$_SESSION['id'].'" >
                       

                       <input type="submit" value="Envoyer" class="btnsearch marge">
                       </div>
                       </form>
                       ';


                   }
                   echo '</div> <hr>';

               }

           }
       }



  echo  '<h1 class="jour"> Evenements passés </h1>';




                        foreach ($events as $event) {
                            $mess='S\'inscire';
                            $heart="fas fa-heart";
                            $messlike='';

                            $i =-1; 




                            if($event->validate == true){


                                if($event->date < date("Y-m-d")){




                                    echo '<div class="boite">
                                    <h1>Evénement : '. $event->name .'</h1>
                                    <hr>
                                    <h6>Date de l\'événement : '. $event->date .  '&nbsp;&nbsp;&nbsp;&nbsp;  ' . 'Prix : ' . $event->price .'€</h6>

                                    <p>Description : '.$event->description.'</p>
                                    ';

                                  ;
                                  echo ' <hr> <h5> Photos de l\'événement : </h5> <div class="row ">
                                  ';

                                  foreach($img as $image){

                                    $i=-1;
                                    if($image['id_event']==$event['id']){

                                        echo ' <div class="col-lg-4 col-md-8 sm-12 text-center"><img src="'.'http://127.0.0.1:8000' .$image['image'] .'" alt="Probleme chargement"

                                        class="" >';
                                    

                                foreach ($likepics as $likepic ) {
                                    if($likepic->id_event == $image->id){
                                        $i=$i+1;
                                    }
                                    if($likepic->id_user == $_SESSION['id'] && $likepic->id_event == $image->id){
                                      $heart="fas fa-heart red";
                                      if ($i==0){
                                        $messlike='';
                                    } else{                                                                                          $messlike ="      Vous et " .$i. " personne(s) ont liké";
                                }   
                                break; 

                            }
                            else{
                              $heart="fas fa-heart";      
                              $messlike='';
                          }
                      }

                      foreach($commentImages as $commentImage){

                         if($commentImage->id_image == $image->id)


                            echo '<p>'. $commentImage->content .'</p> <hr>';



                      }
                         echo '                           
                      
                      <form method="post" action="/like" > '         .  csrf_field() .'
                      <input type="hidden" name="page" value="/event"  >
                      <input type="hidden" name="type" value=4 >
                      <input type="hidden" name="id_event" value='. $image->id .'  >

                      
                      <button type = "submit" class=" like btn  " ><i class="'. $heart.'">' . $messlike. '</i> </button>
                      </form>
                      
                      ';




 if(isset($_SESSION['email'])){

                       echo    '<form action="/commentImage" method="post">'.
                       csrf_field() . '

                     

                       <input type="text"  name="comment" placeholder="Commentaire" class="" required>
                       <input name="id_image" type="hidden" value="'.$image->id .'" >
                       <input name="id_user" type="hidden" value="'.$_SESSION['id'].'" >
                       

                       <input type="submit" value="Envoyer" class="btnsearch marge">
                   
                       </form>
                       </div>
                       ';


                   }

                                    }


                                }


                            

                      echo '</div>';                               
                      
                      

                      foreach ($subscribes as $subscribe) {
                          if(($subscribe->id_user == $_SESSION['id'] && $subscribe->id_event == $event->id )){

                                echo '<hr><h5> Vous avez participé à cet event !! </h5>
                                   <h5> Ajout de photos : </h5>


                      <form method="post" action="/image" enctype= "multipart/form-data"> '.  csrf_field() .


                      '<input type="file" name="userfile" required><br>

                      <input type="hidden" name="id_event" value='. $event->id .'  ><input type="submit" value="OK">

                      
                      </form>
                      
                      <hr>';

                          }
                      }


                   
                      echo '<h6> <b> Commentaires :  </b></h6> <hr>';


                      foreach($comments as $comment){

                        if($comment->id_event == $event->id)


                            echo '<p>'. $comment->content .'</p> <hr>';

                        

                    }



                    if(isset($_SESSION['email'])){

                       echo    '<form action="/comment" method="post">'.
                       csrf_field() .

                       '<div class="input-group form-group">

                       <input type="text" name="comment" placeholder="Commentaire" class="form-control marge" required>
                       <input name="id_event" type="hidden" value="'.$event->id .'" >
                       <input name="id_user" type="hidden" value="'.$_SESSION['id'].'" >
                       

                       <input type="submit" value="Envoyer" class="btnsearch marge">
                       </div>
                       </form>
                       ';


                   }
                   echo '</div> <hr>';

               }

           }
       }

?>


<?php 

if(isset($_SESSION['email'])){


    echo    '<form action="/event" method="post">'.
    csrf_field() .

    '<div class="input-group form-group">

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

    <div class="input-group form-group">
    <input type="submit" value="Envoyer" class="btnsearch marge">
    </div>
    </form>'; 
}else{

}

?>
<div class="col-lg-1 col-md-2 col-sm-3">


</div>

</div>



</div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
