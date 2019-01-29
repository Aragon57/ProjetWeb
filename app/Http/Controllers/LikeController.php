<?php

namespace App\Http\Controllers;


session_start();

use App\Like;
use Illuminate\Http\Request;
use PDF;
class LikeController extends Controller
{  

//Liker une image
     public function store(int $id, Request $request)

    {

        $liked =  Like::where('id_event', $id)
                        ->where('id_user', $_SESSION['id'])
                        ->where('type', 4)

                        ->first();

        if(isset($liked)){ // Si il y a deja un like


           $liked->delete(); // Le supprimer
           return redirect('/event/' .$request->id_event);

        }
        else{



        $like = new Like();
        $like->id_event = $id;
        $like->email =$_SESSION['email'];

        $like->type = 4;
        $like->id_user = $_SESSION['id'];
        $like->save();
        
    return redirect('/event/' .$request->id_event);    }


}
//Voter pour un evenement
     public function storeVote(int $id)
    {

        $liked =  Like::where('id_event', $id)
                        ->where('id_user', $_SESSION['id'])
                        ->where('type', 2)

                        ->first();

        if(isset($liked)){ // Si il y en a deja un 


           $liked->delete();
           return redirect('/idee');

        }
        else{



        $like = new Like();
        $like->id_event = $id;
        $like->email =$_SESSION['email'];

        $like->type = 2;
        $like->id_user = $_SESSION['id'];
        $like->save();
        
    return redirect('/idee');    }


}

    //S'inscrire a un evenement
	
    public function storeRegister(int $id)
    {

        $registered =  Like::where('id_event', $id)
                        ->where('id_user', $_SESSION['id'])
                        ->where('type', 3 )

                        ->first();

        if(isset($registered)){ // Si deja inscrit 


           $registered->delete();
           return redirect('/event/'.$id);

        }
        else{



        $like = new Like();
        $like->id_event = $id;
        $like->email =$_SESSION['email'];

        $like->type = 3;
        $like->id_user = $_SESSION['id'];
        $like->save();
        
    return redirect('/event/'.$id);    }


}


}