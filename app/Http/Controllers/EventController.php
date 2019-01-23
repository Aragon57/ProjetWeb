<?php

namespace App\Http\Controllers;
session_start();
use App\Event;
use App\Users;
use App\Image;
use App\Comment;
use App\commentImage;

use App\Like;

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




    public function display(){
        $events = Event::all();
        $img = Image::all();
         $comments = Comment::all();
 $subscribes = Like::where('type',3)
                ->get();
 $likes = Like::where('type',1)
                ->get();
 $likepics = Like::where('type',4)
                ->get();
         $commentImages = commentImage::all();


    return view('event' , compact('events','img','comments','subscribes','likes','likepics','commentImages'));

    }

}
