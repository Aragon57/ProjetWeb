<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;


class WelcomeController extends Controller
{

  public function display(){


    $events = Event::where('validate',true)->where('date', date('Y-m-d'))->get();
   


    return view('welcome' , compact('events'));

  }

}
