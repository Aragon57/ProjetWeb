<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use App\Event;
use App\Image;
use App\commentImage;
use App\Like;
use PDF;


class EventIdController extends Controller
{
  public function display(int $id){

  	        $event = Event::where('id',$id)->first();
  	        $images = Image::where('id_event',$id)->get();
  	       
  	        $comments = commentImage::all();

if(isset($_SESSION['email'])){

 $likes = Like::where('type',4)->where('id_user', $_SESSION['id'])->get();
  	        $register = Like::where('type', 3)->where('id_user', $_SESSION['id'])->where('id_event',$id)->first();

  	        foreach ($images as  $key =>$image) {

  	        		foreach ($likes as $keys =>$like) {
  	        		  	       	
  	        			if($like->id_event == $image->id){

  	        					$image->liked = true;
  	        				}else{


  	        					$image->liked = false;
  	        				}
  	        		  	 }  	        	

  	        }
  	}

        return view('eventId' , compact('event','images','likes','register','comments'));

 
    }




     public function generatePDF(int $id)

    {

    	$inscrit = Like::where('type',3)->where('id_event' , $id )->get();

        $pdf = PDF::loadView('myPDF',  compact('inscrit'));

        return $pdf->download('Inscrits.pdf'); 

    } 

}