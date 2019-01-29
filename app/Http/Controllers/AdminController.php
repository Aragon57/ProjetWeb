<?php

namespace App\Http\Controllers;

use App\Event;
use App\Commands;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Console\Command;

class AdminController extends Controller {

	public function getusers(Request $request)
	{
		$rawdata = file_get_contents('https://h3cate.herokuapp.com/allusers');//get request on api
		$header = self::parseHeaders($http_response_header);

		if($header['reponse_code'] != 200)//GET returned error?
		{
			return response('error', $header['response_code']);
		}

		$data = json_decode($rawdata, true);

		$columns = array();
		foreach($data[0] as $key=>$value)//parse columns in array
		{
			$columns[] = $key;
		}

		if(isset($request->filter))//filter data if filter exist
		{
			$data = self::filterresult($request->filter, $data);
		}

		$values = array();
		if(empty($data))
		{
			return	view('admin/table', compact('columns', 'values'));
		}

		$values = $data;

		return view('admin/table', compact('columns', 'values'));
	}

	public function getevent(Request $request)
	{
		$data = Event::all();
		
		$columns = array("id", "name", "description", "date", "price", "validate", "punctuality", "past", "id_user");//define columns
		$values = array();
		foreach($data as $event)
		{
			$tmp = array(//get data in array
				$event->id,
				$event->name,
				$event->description,
				$event->date,
				$event->price,
				$event->validate?"true":"false",//boolean number to text
				$event->punctuality?"true":"false",
				$event->past?"true":"false",
				$event->id_user
			);
			$values[] = $tmp;
		}

		if(isset($request->filter))
		{
			$values = self::filterresult($request->filter, $values);
		}

		return view('admin/table', compact('columns', 'values'));
	}

	public function getcommand(Request $request)
	{
		$data = Commands::all();

		$columns = array("id", "id_user", "payed");
		$values = array();
		foreach($data as $command)
		{
			$tmp = array(
				$command->id,
				$command->id_user,
				$command->payed?"true":"false"
			);
			$values[] = $tmp;
		}

		if(isset($request->filter))
		{
			$values = self::filterresult($request->filter, $values);
		}

		return view('admin/table', compact('columns', 'values'));
	}

	public function getarticle(Request $request)
	{
		$data = Product::all();

		$columns = array("id", "name", "description", "price", "stock", "sold", "category");
		$values = array();
		foreach($data as $article)
		{
			$tmp = array(
				$article->id,
				$article->name,
				$article->description,
				$article->price.'€',
				$article->stock,
				$article->nbsell,
				$article->id_category
			);
			$values[] = $tmp;
		}

		if(isset($request->filter))
		{
			$values = self::filterresult($request->filter, $values);
		}

		return view('admin/table', compact('columns', 'values'));
	}

	private function filterresult($filter, $array)
	{
		$filtered = array();
		foreach($array as $item)
		{
			foreach($item as $index => $string)
			{
				if (strpos(strtoupper($string), strtoupper($filter)) !== FALSE)
				{
					$filtered[] = $item;
					break;
				}
			}
		}
		
		return $filtered;
	}

	private function parseHeaders( $headers )
    {
        $head = array();
        foreach( $headers as $k=>$v )//get key and value
        {
            $t = explode( ':', $v, 2 );
            if( isset( $t[1] ) )//split value into key and value
                $head[ trim($t[0]) ] = trim( $t[1] );
            else
            {
                $head[] = $v;
                if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )//return http code only
                    $head['reponse_code'] = intval($out[1]);
            }
        }
        return $head;
    }
}