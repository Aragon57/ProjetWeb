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
                        ->where('type', $request->type)

                        ->first();

        if(isset($liked)){


           $liked->delete();
           return redirect($request->page);

        }
        else{



        $like = new Like();
                          $like->id_event =$request->id_event;

        $like->type =$request->type;
        $like->id_user = $_SESSION['id'];
        $like->save();
        
    return redirect($request->page);    }


}


    public function display(){


    }

}