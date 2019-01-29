<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function store(Request $request)
	{
    	// Ajouter une categorie dans la boutiquz
		$category = new Category();
		$category->name = $request->category;
		$category->save();

		return redirect('/boutique');    }
	}
