<?php
namespace App\Http\Controllers;
session_start();

use App\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function store()
    {
        $result = file_get_contents('https://h3cate.herokuapp.com/request/users/email/'.request()->email);
        $header = self::parseHeaders($http_response_header);
        if($result)
        {
            if($result !== '[]')
            {
                return response('email already exists', 409);
            }
        }
        else
        {
            return response('something went wrong', $header['reponse_code']);
        }

        //validate the request...
        if(request()->password == request()->password_confirmation)
        {
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);

            if(!$uppercase || !$lowercase || !$number || strlen($password) < 8)
            {
                $hash = password_hash(request()->password, PASSWORD_DEFAULT);
                $rawdata = array(
                    "name" => request()->name,
                    "surname" => request()->firstname,
                    "email" => request()->email,
                    "nom" => request()->localisation,
                    "password" => $hash,
                    "id_status" => 1);
                $data = json_encode($rawdata);

                $opts = array('http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => $data
                ));

                $context = stream_context_create($opts);
                $result = file_get_contents('https://h3cate.herokuapp.com/request/users', false, $context);
                $header = self::parseHeaders($http_response_header);

                if($result)
                {
                    return response('success', 200);
                }
                else
                {
                    return response('something went wrong', $header['reponse_code']);
                }

            }
            else
            {
                return response('password doesn\'t meet requirements', 400);
            }
        }
        else
        {
            return response('password doesn\'t match', 400);
        }
    }

    public function connect()
    {
        $result = file_get_contents('https://h3cate.herokuapp.com/request/users/email/'.request()->email);
        $header = self::parseHeaders($http_response_header);

        if($result)
        {
            if($result !== '[]')
            {
                $result = str_replace('[', '', $result);
                $result = str_replace(']', '', $result);

                //$result = json_encode($result);
                $result = json_decode($result, true);
                
                //echo var_dump($result);
                //echo $result->password;

                if(!password_verify(request()->password, $result['password']))
                {
                    return response('wrong email or password', 404);
                }

                $_SESSION['id'] = $result['id'];
                $_SESSION['email'] = $result['email'];
                return response('success', 200);
            }
            else
            {
                return response('wrong email or password', 404);
            }
        }
        else
        {
            return response('something went wrong', $header['reponse_code']);
        }
    }

    public function isLogged()
    {

    }

    public function logout(){
        session_unset();
        return redirect('/');
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
