<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function display() {
        $products = Product::all();


        $threefirst = Product::paginate(3);

        $firsts = Product::orderBy('nbsell','DESC')->paginate(3);

        return view('boutique' , compact('products','firsts'));
    }
        
    }


