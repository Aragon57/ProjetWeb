<?php

namespace App\Http\Controllers;


session_start();

use App\Event;
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



        $ideas = Event::all();


    return view('idee' , compact('ideas'));

    

}


	  public function change(Request $request,$id)
    {
        $posts = Event::findOrFail($id);
        $posts->update($request->all());

}
}
