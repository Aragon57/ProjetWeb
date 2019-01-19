<?php

namespace App\Http\Controllers;
session_start();
use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
   public function store(Request $request)
    {

        if($request->punctuality = "Récurent"){

            $punct = 0;

        }
        else{
            $punct =1;
        }
        $event = new Event();
        $event->titre_manif = $request->title_manif;
        $event->description = $request->desc_manif;
        $event->date = $request->date_manif;
        $event->punctuality = $punct;
        $event->price = $request->price_manif;
        $event->id_user = $_SESSION["id"];



        $event->save();
    return redirect('/');    }

}
