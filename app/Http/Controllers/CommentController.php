<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  public function store(Request $request)
    {


        $comment = new Comment();
        $comment->text = $request->comment;
        $comment->id_user = $request->id_user;
        $comment->id_manif = $request->id_event;
    


        $comment->save();

    return redirect('/');    }



}
