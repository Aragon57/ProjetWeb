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

$ideas = App\Idee::all();

foreach ($ideas as $idea) {
    echo '<div>
            <h1>'. $idea->name_idea .'</h1>
            <p>'.$idea->desc_idea.'</p>
            <hr>';



    
}
?>

		<form action="/idee" method="post">
                            {{ csrf_field() }}

                            <div class="input-group form-group">
                               
                                <input type="text" name="title" placeholder="Titre" require="required" class="form-control marge" >

                            </div>
                            <div class="input-group form-group">
                               
                                <input type="text" name="desc" placeholder="Description" require="required" class="form-control descr" >

                    
                        <div class="input-group form-group">
                            <input type="submit" value="Envoyer" class="btnsearch marge">
                        </div>
                </div>
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
