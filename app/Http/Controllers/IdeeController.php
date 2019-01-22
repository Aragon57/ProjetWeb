<?php

namespace App\Http\Controllers;


session_start();

use App\Event;
use App\EventRegister;

use Illuminate\Http\Request;

class IdeeController extends Controller
{
   
    public function store(Request $request)
    {
        $idee = new Event();
        $idee->name = $request->title;
        $idee->description = $request->desc;
                $idee->validate = false;

        $idee->id_user = $_SESSION['id'];
        $idee->save();
    return redirect('/');    }


    public function display(){


 $eventregisters = EventRegister::all();
        $ideas = Event::where('validate',false) 
                ->get();


    return view('idee' , compact('ideas','eventregisters'));

    

}


	  public function change(Request $request,$id)
    {
        $posts = Event::findOrFail($id);
        $posts->update($request->all());

}
}
