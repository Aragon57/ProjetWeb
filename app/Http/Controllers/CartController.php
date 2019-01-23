<?php
    namespace App\Http\Controllers;

    use App\Cart;
    use App\AddCart;
    use Illuminate\Http\Request;

    session_start();

    class CartController extends Controller
    {
        public function cart() {

            $id = Cart::all()->where('id_user', $_SESSION['id']);

            $content = AddCart::all();
            $filtered = $content->where('id_cart', $id);

            return view('cart' , compact('content','filtered'));
        }

        public function addtocart() {
            
        }
    }
