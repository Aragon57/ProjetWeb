<?php

namespace App\Http\Controllers;
session_start();
use App\Event;
use App\Users;
use App\Image;
use App\Comment;
use App\commentImage;
use ZipArchive;
use App\Like;

use Illuminate\Http\Request;

class EventController extends Controller
{
 public function store(Request $request)
 {

    if($request->punctuality = "Récurent"){

        $punct = false;

    }
    else{
        $punct =true;
    }
    $event = new Event();
    $event->name = $request->title_manif;
    $event->description = $request->desc_manif;
    $event->date = $request->date_manif;
    $event->punctuality = $punct;
    $event->validate = true;
    $event->price = $request->price_manif;
    $event->id_user = $_SESSION["id"];
    $event->email =$_SESSION['email'];
    $event->save();
    return redirect('/');    }

  public function storeComment(Request $request)
    {


        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->id_user = $request->id_user;
        $comment->id_event = $request->id_event;
    


        $comment->save();

    return redirect('/event');    }

public function storeImage(Request $request)
    {


$dossier = "C:\Users\\nicol\webLaravel\storage\app\public\img\\event\\";
$fichier = basename($_FILES['userfile']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['userfile']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG');
$extension = strrchr($_FILES['userfile']['name'], '.'); 
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['userfile']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
         $image = new Image();
        $image->image = '/img/event/'.$_FILES['userfile']['name'];
        $image->id_event = $request->id_event;

        $image->id_user = 1;
        $image->save();
    return redirect('/');   

     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}

}
    public function storeCommentImage(Request $request)
    {


        $commentImage = new commentImage();
        $commentImage->content = $request->comment;
        $commentImage->id_user = $request->id_user;
        $commentImage->id_image = $request->id_image;
    


        $commentImage->save();

    return redirect('/');    }


    public function display(){





        $events = Event::where('validate',true)->orderby('date', 'DESC')->get();
        $img = Image::all();
        $comments = Comment::all();
        $subscribes = Like::where('type',3)
        ->get();
        $likes = Like::where('type',1)
        ->get();
        $likepics = Like::where('type',4)
        ->get();
        $commentImages = commentImage::all();


        return view('event' , compact('events','img','comments','subscribes','likes','likepics','commentImages'));

    }

    public function deleteImage(Request $request)
    {

         $images =  Image::where('id', $request->id_image)
                            ->first();

unlink(storage_path('app\public'.$images->image));

       $image =  Image::where('id', $request->id_image)
                            ->delete();
        $comments =  CommentImage::where('id_image', $request->id_image)
                            ->delete();
        $likes = Like::where('type',4);
                                return redirect('/event'); 

    }
    public function deleteComment(Request $request)
    {

        $comments =  CommentImage::where('id_image', $request->id_image)
                            ->delete();
                                return redirect('/boutique'); 

    }


 
    

}
