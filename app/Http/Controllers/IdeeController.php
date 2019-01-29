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
   

// Fonction qui permet d'ajouter à la BDD une nouvelle idée

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


// Fonction qui permet d'afficher notre vue et de lui envoyer différentes données 

    public function display(){


        $ideas = Event::where('validate',false) 
                ->get();
        $likes= Like::where('type',2)
                ->get();

    return view('idee' , compact('ideas','likes'));

    

}


//Fonction qui permet de faire valider une idée par un membre du BDD

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

// Apres avoir valide, on envoie un mail à l'utilisateur qui a posté l'idée

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
$mail->addAddress($ideaa->email, 'Nicolas S');

$mail->Subject = 'Validation idee';
// on place le message au sein du mail
$mail->Body = 'Votre idee '.$ideaa->name.' est validee par les membres du BDE';
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
