<?php
namespace App\Http\Controllers;
session_start();

use App\Image;
use Illuminate\Http\Request;


class ImageController extends Controller
{


     public function store(Request $request)
    {


        $fichier= $request->fichier;
 
        if(isset($_FILES['fichier'])){
        $nomfichier='event'.$request->id_event .'.'. $i .'.png';
        $chemin=" ..\..\..\public\img\\event\\";}
if (!copy($fichier,$chemin.$nomfichier))
{echo 'erreur';}


       $image = new Image();
        $image->image = '/img/event/'.$nomfichier;
        $image->id_event = $request->id_event;

        $image->id_user = $_SESSION['id'];
        $image->save();
        $i=$i+1;
    return redirect('/');   


    }
}
