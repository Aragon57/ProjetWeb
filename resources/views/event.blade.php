<?php session_start() ?>
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

$events = App\Event::all();

foreach ($events as $event) {
    echo '<div>
            <h1>'. $event->titre_manif .'</h1>

                        <h6>'. $event->date .'</h6>

            <p>'.$event->description.'</p>
            <hr>';

$images = App\Image::all();
foreach($images as $image){

    }
}
?>
<?php 
{{ asset('img/event1.1.jpg') }};

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
