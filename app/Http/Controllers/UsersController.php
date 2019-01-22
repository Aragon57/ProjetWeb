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
            $uppercase = preg_match('@[A-Z]@', request()->password);
            $lowercase = preg_match('@[a-z]@', request()->password);
            $number    = preg_match('@[0-9]@', request()->password);

            if($uppercase && $lowercase && $number && strlen(request()->password) > 8)
            {
                $hash = password_hash(request()->password, PASSWORD_DEFAULT);
                $rawdata = array(
                    "name" => request()->name,
                    "surname" => request()->firstname,
                    "email" => request()->email,
                    "nom" => mb_strtolower(request()->localisation, "UTF-8"),
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

                if($header['reponse_code'] == 200)
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
                $result = json_decode($result, true);

                if(!password_verify(request()->password, $result['password']))
                {
                    return response('wrong email or password', 404);
                }

                $_SESSION['id'] = $result['id'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['status'] = $result['id_status'];

                $rawdata = array(
                    "token" => session_id(),
                    "id" => $_SESSION['id']
                );
                $data = json_encode($rawdata);

                $opts = array('http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => $data
                ));

                $context = stream_context_create($opts);
                $result = file_get_contents('https://h3cate.herokuapp.com/request/token', false, $context);
                $header = self::parseHeaders($http_response_header);

                if($header['reponse_code'] != 200)
                {
                    return response('something went wrong', $header['reponse_code']);
                }
                
                $_SESSION['token'] = session_id();
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
        if(!isset($_SESSION['token']))
        {
            return response('no token', 200);
        }


        //GET user id
        $result = file_get_contents('https://h3cate.herokuapp.com/request/token/token/'.$_SESSION['token']);
        $header = self::parseHeaders($http_response_header);
        
        if($header['reponse_code'] != 200)
        {
            return response('false', $header['reponse_code']);
        }
        
        if($result === '[]')
        {
            return response('false', 200);
        }

        $result = str_replace('[', '', $result);
        $result = str_replace(']', '', $result);
        $result = json_decode($result, true);


        //GET user info
        $result = file_get_contents('https://h3cate.herokuapp.com/request/users/id/'.$result['id']);
        $header = self::parseHeaders($http_response_header);

        if($header['reponse_code'] != 200)
        {
            return response('false', $header['reponse_code']);
        }
        
        if($result === '[]')
        {
            return response('false', 200);
        }

        $result = str_replace('[', '', $result);
        $result = str_replace(']', '', $result);
        $result = json_decode($result, true);

        $_SESSION['id'] = $result['id'];
        $_SESSION['email'] = $result['email'];
        $_SESSION['status'] = $result['id_status'];

        return response('true', 200);
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
