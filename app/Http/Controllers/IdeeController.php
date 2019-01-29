<?php

namespace App\Http\Controllers;


session_start();
use App\Event;
use App\EventRegister;
use App\Like;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

use Illuminate\Http\Request;

class IdeeController extends Controller
{
   
    public function store(Request $request)
    {
        $idee = new Event();
        $idee->name = $request->title;
        $idee->description = $request->desc;
                $idee->validate = false;
        $idee->email = $_SESSION['email'];

        $idee->id_user = $_SESSION['id'];
        $idee->save();
    return redirect('/idee');    }


    public function display(){


        $ideas = Event::where('validate',false) 
                ->get();
        $likes= Like::where('type',2)
                ->get();

    return view('idee' , compact('ideas','likes'));

    

}

  public function storeImage(Request $request)
    {


$dossier = " ..\..\..\public\img\\event\\";
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
    public function update(Request $request)
    {
      $ideaa = Event::where('id', $request->id)
                    ->first();
        $ideaa->id =$request->id;
        $ideaa->validate =1;
        if($request->description != ''){
            $ideaa->description=$request->description;

        }

        $ideaa->price=$request->price;

        $ideaa->id_user =$_SESSION['id'];
        $ideaa->date=$request->date;
        $ideaa->save();


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
$mail->addAddress($ideaa->email, 'Nicolas S');
//Set the subject line
$mail->Subject = 'Validation idee';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//Replace the plain text body with one created manually
$mail->Body = 'Votre idee '.$ideaa->name.' est validee par les membres du BDE';
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

    return redirect('/idee');   


}


    }

}
