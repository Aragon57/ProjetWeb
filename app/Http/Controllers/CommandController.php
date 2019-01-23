<?php
    namespace App\Http\Controllers;

    use App\Commands;
    use App\CartProduct;
    use Illuminate\Http\Request;
    use Illuminate\Console\Command;

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
            try
            {
                $command = App\Commands::where('id_user', '=', $request->id_user)->firstOrFail();
                return $command->id_command;
            }
            catch(Exception $error)
            {
                return false;
            }
        }

        public function addarticle(Request $request) {

            $id_command = self::findcommand($request);
            if(!$id_command)
            {
                $id = self::createcommand($request);
                $request->id_command = $id;
            }

            $article = new CartProduct;
            $article->id_product = $request->id_product;
            $article->id_command = $request->id_command;
            $article->quantity = $request->quantity;

            $article->save();

            return response(true, 200);
        }
    }
