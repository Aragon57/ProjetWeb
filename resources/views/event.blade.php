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


     foreach ($events as $event) {


      if($event->date  > date("Y-m-d")){
        $dat='Evenement à venir';
      }elseif($event->date  == date("Y-m-d")){
                $dat='Evenement du jour';

      }else{
        $dat='Evenement passé';
      }

      $mess='S\'inscire';
      $heart="fas fa-heart";
      $messlike='';

      $i =-1; 










          echo '<div class="boite">
          <h5 class="jour">' . $dat . ' </h5><hr>
          <h1>Evénement : '. $event->name .'</h1>
          <hr>
          <h6>Date de l\'événement : '. $event->date .  '&nbsp;&nbsp;&nbsp;&nbsp;  ' . 'Prix : ' . $event->price .'€</h6>

          <p>Description : '.$event->description.'</p>
          ';

          if($event->date  >= date("Y-m-d")){
                 foreach ($subscribes as $subscribe) {
          if(($subscribe->id_user == $_SESSION['id'] && $subscribe->id_event == $event->id )){
             $mess='Se désinscrire';
             break;
        }else{  $mess='S\'inscire';
        }

        }

  echo    '<form method="post" action="/like" > '         .  csrf_field() .'
          <input type="hidden" name="id_event" value='. $event->id .'  >
                              <input type="hidden" name="type" value=3  >
                              <input type="hidden" name="page" value="/event"  >

          <button type = "submit" class="btnsearch commentdel " >'.  $mess  .'</i></button>
          </form>';

}
          if($event->date  < date("Y-m-d")) {

          echo ' <hr> <h5> Photos de l\'événement : </h5><hr> <div class="row">
          ';

          foreach($img as $image){

            $i=-1;
            if($image['id_event']==$event['id']){

              echo ' <div class="col-lg-4 col-md-8 sm-12 text-center"><img src="'.'/storage' .$image['image'] .'" alt="Probleme chargement"

              class="" >';


              foreach ($likepics as $likepic ) {
                if($likepic->id_event == $image->id){
                  $i=$i+1;
                }
                if($likepic->id_user == $_SESSION['id'] && $likepic->id_event == $image->id){
                  $heart="fas fa-heart red";
                  if ($i==0){
                    $messlike='';
                  } else{                                                                                          
                    $messlike ="      Vous et " .$i. " personne(s) ont liké";

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


              echo '<p class="commentdel">'. $commentImage->content .' 
          <form method="post" action="/comment/delete" > '         .  csrf_field() .'
          <input type="hidden" name="id_image" value='. $image->id .'  >

          <button type = "submit" class="commentdel like btn  " ><i class="fas fa-ban"></i></button>
          </form>
          </p> <hr>';



          }
          echo '                           

          <form method="post" action="/like" > '         .  csrf_field() .'
          <input type="hidden" name="page" value="/event"  >
          <input type="hidden" name="type" value=4 >
          <input type="hidden" name="id_event" value='. $image->id .'  >


          <button type = "submit" class=" like btn  " ><i class="'. $heart.'">' . $messlike. '</i> </button>
          </form>
          
          <form method="post" action="/image/delete" > '         .  csrf_field() .'
          <input type="hidden" name="id_image" value='. $image->id .'  >

          <button type = "submit" class=" like btn  " ><i class="fas fa-ban"></i></button>
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
         
           ';


         }
          echo '</div>';                               

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

      if($comment->id_event == $event->id){


        echo '<p>'. $comment->content .'</p> <hr>';



    }

}

    if(isset($_SESSION['email'])){

     echo    '<form action="/comment" method="post">'.
     csrf_field() .

     '<div class="input-group form-group">

     <input type="text" name="comment" placeholder="Commentaire" class="form-control marge" required>
     <input name="id_event" type="hidden" value="'.$event->id .'" >
     <input name="id_user" type="hidden" value="'.$_SESSION['id'].'" >


     <input type="submit" value="Envoyer" class="btnsearch marge">
  
     </form>
    </div>
     ';


   }



}


   echo '</div> <hr>';


}


?>


 <h1>Create and Download Zip file using PHP</h1>
 <form method='post' action='/event/downloadPic'>
    @csrf

   <input type='submit' name='download' value='Download' />
 </form>


<?php 

if($_SESSION['status']==4){


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
