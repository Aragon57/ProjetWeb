<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Console\Command;

class AdminController extends Controller {

	public function getusers(Request $request)
	{
		$rawdata = file_get_contents('https://h3cate.herokuapp.com/allusers');
		$header = self::parseHeaders($http_response_header);

		if($header['reponse_code'] != 200)
		{
			return response('error', $header['response_code']);
		}

		$data = json_decode($rawdata, true);

		$columns = array();
		foreach($data[0] as $key=>$value)
		{
			$columns[] = $key;
		}

		$values = $data;

		$response[] = $columns;
		$response[] = $data;

		return view('admin/table', compact('columns', 'values'));
		//return response($response, 200);
	}

	private function parseHeaders( $headers )
    {
        $head = array();
        foreach( $headers as $k=>$v )
        {
            $t = explode( ':', $v, 2 );
            if( isset( $t[1] ) )
                $head[ trim($t[0]) ] = trim( $t[1] );
            else
            {
                $head[] = $v;
                if( preg_match( "#HTTP/[0-9\.]+\s+([0-9]+)#",$v, $out ) )
                    $head['reponse_code'] = intval($out[1]);
            }
        }
        return $head;
    }
}