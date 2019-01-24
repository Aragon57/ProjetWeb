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

        public function deleteproduct($id) {
            $article = CartProduct::where('id_command', '=', $_SESSION['id_cart'])->where('id_product', '=', $id)->get();
            $article->forceDelete();

            return response('true', 200);
        }
    }
