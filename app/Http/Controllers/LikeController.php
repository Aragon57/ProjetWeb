<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

     public function store(Request $request)
    {
        $like = new Like();
        $like->type = 1;
        $like->id_event = $request->id_event;

        $like->id_user = $_SESSION['id'];
        $like->save();
    return redirect('/');    }


}