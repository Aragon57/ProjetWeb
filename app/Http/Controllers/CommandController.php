<?php
namespace App\Http\Controllers;

use App\Commands;
use App\CartProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Symfony\Component\Debug\Exception\FatalThrowableError;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
session_start();

class CommandController extends Controller
{
    public function command() {

        $id = Cart::all()->where('id_user', $_SESSION['id']);

        $content = AddCart::all();
        $filtered = $content->where('id_cart', $id);

        return view('cart' , compact('content','filtered'));
    }

    public function createcommand(Request $request) {
        $command = new Commands;
        $command->id_user = $request->id_user;
        $command->paye = false;

        $command->save();

        $command = Commands::where('id_user', $request->id_user)->get();

        return $command->id;
    }

    public function findcommand(Request $request) {
        $command = Commands::where('id_user', '=', $request->id_user)->where('paye', '=', '0')->first();
        if($command == null)
        {
            return false;//si aucune commande trouver, retourner faux
        }
        
        return $command->id;
    }

    public function addarticle(Request $request) {
        
        $id_command = self::findcommand($request);
        if(!$id_command)//si faux creer une nouvelle commande
        {
            $id = self::createcommand($request);
            $request->id_command = $id;
        }
        else
        {
            $request->id_command = $id_command;
        }

        $_SESSION['id_cart'] = $request->id_command;

        $product_id = self::findproduct($request);
        if($product_id)//si produit existe deja incrementer la quantité
        {
            $article = CartProduct::find($product_id);
            $article->quantity += $request->quantity; 
        }
        else
        {
            $article = new CartProduct;
            $article->id_product = $request->id_product;
            $article->id_command = $request->id_command;
            $article->quantity = $request->quantity;
        }

        $article->save();

        return response("true", 200);
    }

    public function findproduct(Request $request) {
        $product = CartProduct::where('id_command', '=', $request->id_command)
        ->where('id_product', '=', $request->id_product)
        ->first();
        
        if($product == null)//retourne faux si le produit n'est pas trouver dans une commande
        {
            return false;
        }
        
        return $product->id;
    }

    public function show(Request $request) {
        if(!isset($_SESSION['id_cart']))
        {
            return view('cart');
        }

        $articles = CartProduct::where('id_command', '=', $_SESSION['id_cart'])->get();
        
        return view('cart', compact("articles"));
    }

    public function deleteproduct(Request $request) {
        $article = CartProduct::where('id', '=', $request->id)->first();
        $article->forceDelete();

        return response('true', 200);
    }

    public function updatequantity(Request $request) {
        $article = CartProduct::find($request->id);
        $article->quantity = $request->quantity;

        $article->save();

        return response('true', 200);
    }


    public function validateCommand(){

        $command = Commands::where('id' , $_SESSION['id_cart'])->where('paye', 0)->first();
        $command->paye = 1;//mettre commande comme payé
        $command->save();

        $products = CartProduct::where('id_command', $_SESSION['id_cart'])->get();//recuperer les produit de la commande


        //mettre a jour la quantité vendu pour chaque produit
        foreach($products as $product){
            $pro = Product::where('id', $product->id_product)->first();
            $addpro = Product::where('id', $product->id_product)               
            ->update(['nbsell' => $pro->nbsell + $product->quantity]);
        }


        //Gestion et envoi des mails
        date_default_timezone_set('Etc/UTC');
        require '../vendor/autoload.php';
            
        $mail = new PHPMailer;
            
        $mail->isSMTP();
            
        $mail->SMTPDebug = 2;
       
        $mail->Debugoutput = 'html';
          
        $mail->Host = 'smtp.gmail.com';

        $mail->Port = 587;
          
        $mail->SMTPSecure = 'tls';
       
        $mail->SMTPAuth = true;
        
        $mail->Username = "noreply.bde@gmail.com";
       
        $mail->Password = "Jesuiskillian";
           
        $mail->setFrom('noreply.bde@gmail.com', 'BDE');
           
        $mail->addAddress($_SESSION['email'], 'BDE');

            
        $mail->Subject = 'Validation de votre commande';
           
        $mail->Body = 'Votre commande est valide, nous vous attendons pour proceder a l\'echange';
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
            unset($_SESSION['id_cart']);

            return redirect('/boutique');   


        }

        return;
    }
}
