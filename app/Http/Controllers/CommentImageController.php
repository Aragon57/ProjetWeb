<?php

namespace App\Http\Controllers;

use App\commentImage;
use Illuminate\Http\Request;

class CommentImageController extends Controller
{
   public function store(Request $request)
    {


        $commentImage = new commentImage();
        $commentImage->content = $request->comment;
        $commentImage->id_user = $request->id_user;
        $commentImage->id_image = $request->id_image;
    


        $commentImage->save();

    return redirect('/');    }
}
