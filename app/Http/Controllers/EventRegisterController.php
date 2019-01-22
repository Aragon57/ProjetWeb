<?php

namespace App\Http\Controllers;
session_start();
use App\EventRegister;
use Illuminate\Http\Request;

class EventRegisterController extends Controller
{

      public function store(Request $request)
    {

         $eventregistered =  EventRegister::where('id_event', $request->id_event)
                        ->where('id_user', $_SESSION['id'])
                        ->first();

        if(isset($eventregistered)){
            $eventregistered->delete();
               return redirect('/');
        }

        else{
        $eventregister = new EventRegister();
        $eventregister->id_event = $request->id_event;
        $eventregister->id_user = $_SESSION['id'];
    


        $eventregister->save();

    return redirect('/');    }
}


public function display(){


}


}
