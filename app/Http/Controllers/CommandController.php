<?php
    namespace App\Http\Controllers;

    use App\Commands;
    use App\CartProduct;
    use Illuminate\Http\Request;
    use Illuminate\Console\Command;
    use Symfony\Component\Debug\Exception\FatalThrowableError;

    session_start();
    $_SESSION['id_cart'] = 1;

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
            $command = Commands::where('id_user', '=', $request->id_user)->first();
            if($command == null)
            {
                return false;
            }
            
            return $command->id;
        }

        public function addarticle(Request $request) {
            
            $id_command = self::findcommand($request);
            if(!$id_command)
            {
                $id = self::createcommand($request);
                $request->id_command = $id;
            }
            else
            {
                $request->id_command = $id_command;
            }

            $product_id = self::findproduct($request);
            if($product_id)
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
            
            if($product == null)
            {
                return false;
            }
                
            return $product->id;
        }

        public function show(Request $request) {
            if(!isset($_SESSION['id_cart']))
            {
                return view('cart', compact($articles));
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
			$mail->setFrom('noreply.bde@gmail.com', 'Finalisation commande');
			//Set an alternative reply-to address
			//Set who the message is to be sent to
			$mail->addAddress($_SESSION['id']);
			//Set the subject line
			$mail->Subject = 'Finalisation commande';
			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			//Replace the plain text body with one created manually
			$mail->Body = 'Nous avons bien recu votre commande, nous allons planifier un rendez-vous afin de proceder au payement et a l\'echange';
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
