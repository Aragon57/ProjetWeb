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
use Response;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class EventController extends Controller
{


//Function store qui permet d'ajouter à la BDD un nouvel événement

 public function store(Request $request)
 {


  if(isset($_FILES['userfile']['name'])){
    $dossier =storage_path('app\public\img\eventHeader\\');

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


  $event->logo = "/img/eventHeader/".$_FILES['userfile']['name'];

$event->email =$_SESSION['email'];
$event->save();
return redirect('/event');



}

//Function storeImage qui permet d'ajouter à la BDD et au site une nouvelle image pour un événement 



  public function storeImage(int $id, Request $request)
  {


    $dossier = storage_path('app\public\img\event\\');
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
      $image->id_event = $id;

      $image->id_user = $_SESSION['id'];
      $image->save();
      return redirect('/event/'. $request->id_event);   

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


//Function storeCommentImage qui permet d'ajouter à la BDD  et au site un nouveau commentaire lié à une image


public function storeCommentImage(Request $request)
{


  $commentImage = new commentImage();
  $commentImage->content = $request->comment;
  $commentImage->id_user = $_SESSION['id'];
  $commentImage->id_image = $request->id_image;



  $commentImage->save();

  return redirect('/event/'. $request->id_event);    }


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

  //Function DeleteImage qui permet de supprimer une image


  public function deleteImage(int $id, Request $request)
  {

   $images =  Image::where('id', $id)
   ->first();

   //On supprime l'image dans le dossier storage

   unlink(storage_path('app\public'.$images->image));


  //On supprimer ensuite le lien de l'image ainsi que les commentaires et les réactions lié à l'image

   $image =  Image::where('id', $id)
   ->delete();
   $comments =  CommentImage::where('id_image', $id)
   ->delete();
   $likes = Like::where('type',4)
   ->where('id_event', $id)
   ->delete();
   return redirect('/event/'. $request->id_event); 

 }



 //Function deleteComment qui permet de supprimer un commentaire lié à une image

 public function deleteComment(Request $request)
 {

  $comments =  CommentImage::where('id_image', $request->id_image)->where('id', $request->id_com)
  ->delete();
  return redirect('/event/'. $request->id_event); 

}


//Function get_file qui permet de récupérer l'ensemble des photos posté par les élèves

public function get_file()
{

           // On récupère le lien de nos image
  $rootPath = storage_path('app\public\img\event');

// On zippe notre fichier
  $zip = new ZipArchive();
  $zip->open('photos.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Création d'une iteration du dossier
  $files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
  );

  foreach ($files as $name => $file)
  {
    // On passe le fichier source ( il est ajouté automatiquement )
    if (!$file->isDir())
    {
        // On récupère les chemins relative et reel
      $filePath = $file->getRealPath();
      $relativePath = substr($filePath, strlen($rootPath) + 1);

        // On ajoute notre photo à l'archive
      $zip->addFile($filePath, $relativePath);
    }
  }

// Le dossier zip va etre créer à la fermeture
  $zip->close();

//On envoie le lien de téléchargement 

  return response()->download(public_path('photos.zip'));

}




//Function report qui permet d'envoyer un mail aux membres du BDE avertissant le fait qu'une partie du contenu est inaproprié

public function report(int $id, Request $request){


//Selon le type renvoyé, on change l'objet et le message du mail


if($request->type ==1){
  $mess='L\'image avec l\'id' .$id.' vient d\'etre signale par un membre du CESI';
  $objet= 'Report image';
}elseif($request->type == 2){
  $mess='Le commentaire avec l\'id' .$id.' vient d\'etre signale par un membre du CESI';
  $objet= 'Report commentaire';
}else{
  $mess='L\'evenement avec l\'id' .$id.' vient d\'etre signale par un membre du CESI';
  $objet= 'Report evenement';
}


  date_default_timezone_set('Etc/UTC');
  require '../vendor/autoload.php';
//Création d'une instance de PHPMailer
  $mail = new PHPMailer;
//utilisation de SMTP
  $mail->isSMTP();
//Autorisation du debugage de SMTP
  $mail->SMTPDebug = 2;
  $mail->Debugoutput = 'html';
//On initialise le hostname
  $mail->Host = 'smtp.gmail.com';
//On initialise le port à utiliser
  $mail->Port = 587;

  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth = true;
//Utilisateur du compte mail
  $mail->Username = "noreply.bde@gmail.com";
//Mot de passe du compte
  $mail->Password = "Jesuiskillian";
//Initialisation de l'expediteur
  $mail->setFrom('noreply.bde@gmail.com', 'BDE');
//Initialisation des adresses de réception
  $mail->addAddress('bde.a2.projetweb.stg@cesi.fr', 'BDE');
  $mail->addAddress('killian.hirtzlin@viacesi.fr', 'BDE');

  $mail->Subject = $objet;
// on place le message au sein du mail
  $mail->Body = $mess;
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Message sent!";

    return redirect('/event/'.$request->id_event);   


  }


}






}
