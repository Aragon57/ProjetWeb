<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function store(Request $request)
    {


        $category = new Category();
        $category->name = $request->category;
        $category->save();

    return redirect('/boutique');    }
}
