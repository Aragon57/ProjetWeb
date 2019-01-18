<?php

namespace App\Http\Controllers;

use App\Idee;
use Illuminate\Http\Request;

class IdeeController extends Controller
{
   
    public function store(Request $request)
    {
        $idee = new Idee();
        $idee->name_idea = $request->title;
        $idee->desc_idea = $request->desc;

        $idee->save();
    return redirect('/');    }
}
