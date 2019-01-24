<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{


	 public function addarticle(Request $request){
$dossier = 'C:\Users\fakep\projetwebcesi\public\img\boutique\\';
$fichier = basename($_FILES['userfile']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['userfile']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
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

        $catt=0;
          echo 'Upload effectué avec succès !';
           $categoriess = Category::all();
    foreach($categoriess as $category){
        if($category->name == $request->category){
            $catt=$category->id;
            break;
        }
    }

           $article = new Product();

        $article->name = $request->name;
        $article->description = $request->description;
        $article->price = $request->price;
        $article->stock = $request->stock;
        $article->nbsell = 0;
        $article->image ='img/boutique/'.$_FILES['userfile']['name'];
        $article->id_category = $catt;
        $article->save();

    return redirect('/boutique'); 
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

    
    public function display() {

    
        $products = Product::all();

        $categories = Category::all();

        $threefirst = Product::paginate(3);

        $firsts = Product::orderBy('nbsell','DESC')->paginate(3);

        return view('boutique' , compact('products','firsts','categories'));
    }


      public function destroy(Request $request)
    {
        $product =  Product::where('id', $request->id_product)
                            ->delete();
                                return redirect('/boutique'); 

    }


    public function getProduct($request) {
         $article = Product::where('id', '=', $request->id_product)->get();
         return view('cart', compact("article"));
    }
        
    }


