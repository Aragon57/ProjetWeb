<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">

    <title>Laravel</title>
    <!-- Fonts -->

    <!-- Styles -->
    <body style ="background-color:#1d2124">
        <?php include('C:\Users\nicol\webLaravel\resources\views\nav.blade.php'); ?>






        <div class="container-fluid  "> 
            <div class="container-fluid "> 
                <div class="row">
                    <div class="col-lg-1 col-md-2 col-sm-3 ">

                    </div>
                    <div class="col-lg-10 col-md-20 col-sm-30 whitos ">


                        <?php





                        echo '<h1>Evenements du jour </h1>';


                        foreach ($events as $event) {

                            if($event->validate == true){


                                if($event->date == date("Y-m-d")){

                                    echo '<div>
                                    <h1>'. $event->titre_manif .'</h1>

                                    <h6>'. $event->date .'</h6>

                                    <p>'.$event->description.'</p>
                                    ';

                                    if(isset($_SESSION['email'])){
                                        echo '<div><input class="favorite styled" type="button" value="S\'inscire"></div>';
                                    }




                                    ;


                                    foreach($img as $image){


                                        if($image['id_event']==$event['id']){

                                            echo '<img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" width="20%/9" height="20%/9">';
                                        }
                                    }



                                     echo '<div>
                              
                               <form method="post" action="/image" enctype= "multipart/form-data"> '                .  csrf_field() .


                               '<input type="file" name="fichier" required><br>

                               <input type="hidden" name="id_event" value='. $event->id .'  >

                               <input type="submit" value="OK">
                               </form>
                               </div> ';


                                    foreach($comments as $comment){

                                        if($comment->id_manif == $event->id_manif)
                                            echo '<p>'. $comment->text .'</p>';

                                    }



                                    if(isset($_SESSION['email'])){

                                       echo    '<form action="/comment" method="post">'.
                                       csrf_field() .

                                       '<div class="input-group form-group">

                                       <input type="text" id="comment" name="comment" placeholder="Commentaire" require="required" class="form-control marge" >
                                       <input id="id_event" name="id_event" type="hidden" value="'.$event->id_manif .'">
                                       <input id="id_user" name="id_user" type="hidden" value="'.$_SESSION['id'].'">
                                       </div>

                                       <div class="input-group form-group">
                                       <input type="submit" value="Envoyer" class="btnsearch marge">
                                       </div>
                                       </form>
                                       ';


                                   }
                                   echo '<hr>';

                               }

                           }
                       }

                       echo '<h1>Evenements à venir </h1>';




                       foreach ($events as $event) {


                        if($event->validate == 1){


                            if($event->date > date("Y-m-d")){
                                echo '<div>
                                <h1>'. $event->name .'</h1>

                                <h6>'. $event->date .'</h6>

                                <p>'.$event->description.'</p>
                                ';


                                if(isset($_SESSION['email'])){
                                    echo '<input class="favorite styled" type="button" value="S\'inscire">';
                                }

                                foreach($img as $image){


                                    if($image['id_event']==$event['id']){
                                        echo '<img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" width="20%/9" height="20%/9">';
                                    }
                                }

                                 echo '<input type="checkbox" id="showpopup"/>
                               <label for="showpopup"><i class="fas fa-camera  photo"></i></label>
                               <div id="popup">
                               <form method="post" action="/image" enctype= "multipart/form-data"> '                .  csrf_field() .


                               '<input type="file" name="fichier"><br>
                               <input type="text" name="namefile" placeholder="Nom du fichier"><br>

                               <input type="hidden" name="id_event" value='. $event->id .'  >

                               <input type="submit" value="OK">
                               </form>
                               </div>';


                                foreach($comments as $comment){

                                    if($comment->id_manif == $event->id_manif)
                                        echo '<p>'. $comment->text .'</p>';

                                }



                                if(isset($_SESSION['email'])){

                                   echo    '<form action="/comment" method="post">'.
                                   csrf_field() .

                                   '<div class="input-group form-group">

                                   <input type="text" id="comment" name="comment" placeholder="Commentaire" require="required" class="form-control marge" >
                                   <input id="id_event" name="id_event" type="hidden" value="'.$event->id_manif .'">
                                   <input id="id_user" name="id_user" type="hidden" value="'.$_SESSION['id'].'">
                                   </div>

                                   <div class="input-group form-group">
                                   <input type="submit" value="Envoyer" class="btnsearch marge">
                                   </div>
                                   </form>
                                   ';
                               }

                               echo '<hr>';
                           }
                       }
                   }



                   echo  '<h1> Evenements passés </h1>';




                   foreach ($events as $event) {

                    if($event->validate == true){

                        if($event->date < date("Y-m-d")){


                            echo '<div>
                            <h1>'. $event->titre_manif .'</h1>

                            <h6>'. $event->date .'</h6>

                            <p>'.$event->description.'</p>
                            ';




                            if(isset($_SESSION['email'])){
                                echo '<input class="favorite styled" type="button" value="S\'inscire">';
                            }

                            foreach($img as $image){


                                if($image['id_event']==$event['id']){
                                    echo '<img src="'.'http://127.0.0.1:8000' .$image['image'] .'" class="" width="20%/9" height="20%/9">';
                                }
                            }



                             echo '<input type="checkbox" id="showpopup"/>
                               <label for="showpopup"><i class="fas fa-camera  photo"></i></label>
                               <div id="popup">
                               <form method="post" action="/image" enctype= "multipart/form-data"> '                .  csrf_field() .


                               '<input type="file" name="fichier"><br>
                               <input type="text" name="namefile" placeholder="Nom du fichier"><br>

                               <input type="hidden" name="id_event" value='. $event->id .'  >

                               <input type="submit" value="OK">
                               </form>
                               </div>';


                            if(isset($_SESSION['email'])){

                               echo    '<form action="/comment" method="post">'.
                               csrf_field() .

                               '<div class="input-group form-group">

                               <input type="text" id="comment" name="comment" placeholder="Commentaire" require="required" class="form-control marge" >
                               <input id="id_event" name="id_event" type="hidden" value="'.$event->id_manif .'">
                               <input id="id_user" name="id_user" type="hidden" value="'.$_SESSION['id'].'">
                               </div>

                               <div class="input-group form-group">
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

                if($_SESSION['status'] == 2){
                    echo    '<form action="/event" method="post">'.
                    csrf_field() .

                    '<div class="input-group form-group">

                    <input type="text" name="title_manif" placeholder="Titre" require="required" class="form-control marge" >

                    </div>
                    <div class="input-group form-group">

                    <input type="date" name="date_manif" placeholder="Date" require="required" class="form-control marge" >

                    </div>
                    <div class="input-group form-group">

                    <input type="float" name="price_manif" placeholder="Prix" require="required" class="form-control marge" >

                    </div>
                    <div class="input-group form-group">

                    <SELECT class="form-control" name="punctuality" size="1">
                    <OPTION>Récurent 
                    <OPTION>Ponctuelle

                    </SELECT>
                    </div>
                    <div class="input-group form-group">

                    <input type="text" name="desc_manif" placeholder="Description" require="required" class="form-control descr" >


                    <div class="input-group form-group">
                    <input type="submit" value="Envoyer" class="btnsearch marge">
                    </div>
                    </div>'; 
                }else{

                }
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
