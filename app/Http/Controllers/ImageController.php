<?php
namespace App\Http\Controllers;
session_start();

use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
     public function store(Request $request)
    {

$token = openssl_random_pseudo_bytes(16);

$token = bin2hex($token);

        $fichier= $request->fichier;
        if(isset($_FILES['fichier'])){  
        $nomfichier='event'.$request->id_event .'.'. $token . '.png';
        $chemin=" ..\..\..\public\img\\event\\";}
        if (!copy($fichier,$chemin.$nomfichier))
        {echo 'erreur';}


       $image = new Image();
        $image->image = '/img/event/'.$nomfichier;
        $image->id_event = $request->id_event;

        $image->id_user = $_SESSION['id'];
        $image->save();
    return redirect('/');   


    }
}
