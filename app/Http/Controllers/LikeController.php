<?php

namespace App\Http\Controllers;

session_start();

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    
     public function store(Request $request)
    {

        $liked =  Like::where('id_event', $request->id_event)
                        ->where('id_user', $_SESSION['id'])
                        ->first();

        if(isset($liked)){


           $liked->delete();
           return redirect('/event');

        }
        else{
        $like = new Like();
        $like->type = 1;
        $like->id_event = $request->id_event;

        $like->id_user = $_SESSION['id'];
        $like->save();
        
    return redirect('/event');    }


}
}