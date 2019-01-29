<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // Recuperation des articles depuis la bdd
	public function addarticle(Request $request)
	{
		$dossier = storage_path('app\public\img\boutique\\');
		$fichier = basename($_FILES['userfile']['name']);
		$taille_maxi = 100000;
		$taille = filesize($_FILES['userfile']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['userfile']['name'], '.'); 

        // Verification de sécurité
        // Si l'extension n'est pas dans le tableau on fait :
		if (!in_array($extension, $extensions))
		{
			$erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
		}
		if ($taille > $taille_maxi) {
			$erreur = 'Le fichier est trop gros...';
		}

		// Upload du fichier si aucune erreur
		if (!isset($erreur))
		{

            // On formate le nom du fichier 
			$fichier = strtr(
				$fichier,
				'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
				'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
			);
			
			$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
			// Si la fonction renvoie TRUE, c'est que ça a fonctionné
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $dossier . $fichier))
			{

				$catt = 0;
				echo 'Upload effectué avec succès !';
				$categoriess = Category::all();
				foreach ($categoriess as $category) {
					if ($category->name == $request->category) {
						$catt = $category->id;
						break;
					}
				}

				$article = new Product();
				$article->name = $request->name;
				$article->description = $request->description;
				$article->price = $request->price;
				$article->stock = $request->stock;
				$article->nbsell = 0;
				$article->image = 'img/boutique/' . $_FILES['userfile']['name'];
				$article->id_category = $catt;
				$article->save();

				return redirect('/boutique');
		    // Sinon (la fonction renvoie FALSE.
			} else 
			{
				echo 'Echec de l\'upload !';
			}
		} else {
			echo $erreur;
		}

	}

    // Afficher les articles selon des critères(meilleures ventes, ect...)
	public function display()
	{


		$products = Product::all();

		$categories = Category::all();

		$threefirst = Product::paginate(3);

		$firsts = Product::orderBy('nbsell', 'DESC')->paginate(3);

		return view('boutique', compact('products', 'firsts', 'categories'));
	}

    // Supprimer un article
	public function destroy(Request $request)
	{
		$product = Product::where('id', $request->id_product)
		->delete();
		return redirect('/boutique');

	}

 
	public function getProduct($request)
	{
		$article = Product::where('id', '=', $request->id_product)->get();
		return view('cart', compact("article"));
	}

    
	public function searchby(Request $request)
	{
		$products = Product::where('name', 'like', '%'.request()->search.'%')->get();
		$categories = Category::all();
		$threefirst = Product::paginate(3);
		$firsts = Product::orderBy('nbsell', 'DESC')->paginate(3);
		
		return view('boutique', compact('products', 'firsts', 'categories'));
	}
}


