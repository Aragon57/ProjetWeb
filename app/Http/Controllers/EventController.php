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
 public function store(Request $request)
 {


  if(isset($_FILES['userfile2']['name'])){
    $dossier = "C:\Users\\nicol\webLaravel\storage\app\public\img\\eventHeader\\";

    $fichier = basename($_FILES['userfile2']['name']);
    $taille_maxi = 100000;
    $taille = filesize($_FILES['userfile2']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG');
    $extension = strrchr($_FILES['userfile2']['name'], '.'); 
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
     if(move_uploaded_file($_FILES['userfile2']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
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

if(isset($_FILES['userfile2']['name']))
{
  $event->logo = "/img/eventHeader/".$_FILES['userfile2']['name'];
}

$event->email =$_SESSION['email'];
$event->save();
return response('true', 200); 



}

public function storeComment(Request $request)
{


  $comment = new Comment();
  $comment->content = $request->comment;
  $comment->id_user = $request->id_user;
  $comment->id_event = $request->id_event;



  $comment->save();

  return redirect('/event'. $request->id_event);    }

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

  public function deleteImage(int $id, Request $request)
  {

   $images =  Image::where('id', $id)
   ->first();

   unlink(storage_path('app\public'.$images->image));

   $image =  Image::where('id', $id)
   ->delete();
   $comments =  CommentImage::where('id_image', $id)
   ->delete();
   $likes = Like::where('type',4)
   ->where('id_event', $id)
   ->delete();
   return redirect('/event/'. $request->id_event); 

 }
 public function deleteComment(Request $request)
 {

  $comments =  CommentImage::where('id_image', $request->id_image)->where('id', $request->id_com)
  ->delete();
  return redirect('/event/'. $request->id_event); 

}



public function get_file()
{

           // Get real path for our folder
  $rootPath = storage_path('app\public\img\event');

// Initialize archive object
  $zip = new ZipArchive();
  $zip->open('photos.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
  /** @var SplFileInfo[] $files */
  $files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
  );

  foreach ($files as $name => $file)
  {
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
      $filePath = $file->getRealPath();
      $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
      $zip->addFile($filePath, $relativePath);
    }
  }

// Zip archive will be created only after closing object
  $zip->close();

  return response()->download(public_path('photos.zip'));

}


public function reportImage(int $id, Request $request){


  date_default_timezone_set('Etc/UTC');
  require '../vendor/autoload.php';
//Create a new PHPMailer instance
  $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
  $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
  $mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
//Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
  $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "noreply.bde@gmail.com";
//Password to use for SMTP authentication
  $mail->Password = "Jesuiskillian";
//Set who the message is to be sent from
  $mail->setFrom('noreply.bde@gmail.com', 'BDE');
//Set an alternative reply-to address
//Set who the message is to be sent to
  $mail->addAddress('bde.a2.projetweb.stg@cesi.fr', 'BDE');
  $mail->addAddress('killian.hirtzlin@viacesi.fr', 'BDE');

//Set the subject line
  $mail->Subject = 'Report image';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Replace the plain text body with one created manually
  $mail->Body = 'L\image avec l\'id' .$id.' vient d\'etre signale par un membre du CESI';
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
//Attach an image file
//send the message, check for errors
  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Message sent!";

    return redirect('/event/'.$request->id_event);   


  }


}

public function reportComment(int $id, Request $request){


  date_default_timezone_set('Etc/UTC');
  require '../vendor/autoload.php';
//Create a new PHPMailer instance
  $mail = new PHPMailer;
//Tell PHPMailer to use SMTP
  $mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
  $mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
//Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
  $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "noreply.bde@gmail.com";
//Password to use for SMTP authentication
  $mail->Password = "Jesuiskillian";
//Set who the message is to be sent from
  $mail->setFrom('noreply.bde@gmail.com', 'BDE');
//Set an alternative reply-to address
//Set who the message is to be sent to
  $mail->addAddress('bde.a2.projetweb.stg@cesi.fr', 'BDE');
  $mail->addAddress('killian.hirtzlin@viacesi.fr', 'BDE');

//Set the subject line
  $mail->Subject = 'Report commentaire';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Replace the plain text body with one created manually
  $mail->Body = 'Le commentaire avec l\'id' .$id.' vient d\'etre signale par un membre du CESI';
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
//Attach an image file
//send the message, check for errors
  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Message sent!";

    return redirect('/event/'. $request->id_event);   


  }


}

public function reportEvent(int $id){


  date_default_timezone_set('Etc/UTC');
  require '../vendor/autoload.php';
  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
//Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
  $mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "noreply.bde@gmail.com";
//Password to use for SMTP authentication
  $mail->Password = "Jesuiskillian";
//Set who the message is to be sent from
  $mail->setFrom('noreply.bde@gmail.com', 'BDE');
//Set an alternative reply-to address
//Set who the message is to be sent to
  $mail->addAddress('bde.a2.projetweb.stg@cesi.fr', 'BDE');
  $mail->addAddress('killian.hirtzlin@viacesi.fr', 'BDE');

//Set the subject line
  $mail->Subject = 'Report Event';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Replace the plain text body with one created manually
  $mail->Body = 'L\'evenement avec l\'id' .$id.' vient d\'etre signale par un membre du CESI';
  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );
//Attach an image file
//send the message, check for errors
  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Message sent!";

    return redirect('/event/'.$id);   


  }


}





}
