<?php

namespace App\Http\Controllers;
session_start();
use App\Event;
use App\Image;
use App\Comment;


use Illuminate\Http\Request;

class EventController extends Controller
{
   public function store(Request $request)
    {

        if($request->punctuality = "Récurent"){

            $punct = false;

        }
        else{
            $punct =true;
        }
        $event = new Event();
        $event->name = $request->title_manif;
        $event->description = $request->desc_manif;
        $event->date = $request->date_manif;
        $event->punctuality = $punct;
        $event->validate = true;
        $event->price = $request->price_manif;
        $event->id_user = $_SESSION["id"];



        $event->save();
    return redirect('/');    }


public function storeComment(Request $request)
    {


        $comment = new Comment();
        $comment->text = $request->comment;
        $comment->id_user = $request->id_user;
        $comment->id_manif = $request->id_event;
    


        $comment->save();

    return redirect('/');    }


    public function display(){
        $events = Event::all();
        $img = Image::all();
         $comments = Comment::all();



    return view('event' , compact('events','img','comments'));

    }

}
