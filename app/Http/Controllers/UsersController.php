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
        $result = file_get_contents('https://h3cate.herokuapp.com/request/users/email/'.request()->email);//requete GET sur API
        $header = self::parseHeaders($http_response_header);
        if($result)
        {
            if($result !== '[]')//si result obj non vide, retourner erreur 409
            {
                return response('email already exists', 409);
            }
        }
        else
        {
            return response('something went wrong', $header['reponse_code']);//si pas de resultat renvoyer l'erreur de l'API
        }

        //valider la requete...
        if(request()->password == request()->password_confirmation)//mdp == mdp de confirmation
        {
            $uppercase = preg_match('@[A-Z]@', request()->password);//verif lettre majuscule existe
            $lowercase = preg_match('@[a-z]@', request()->password);//verif lettre minuscule existe
            $number    = preg_match('@[0-9]@', request()->password);//verif nombre existe

            if($uppercase && $lowercase && $number && strlen(request()->password) > 3)//si regex passe et mdp > 3
            {
                $hash = password_hash(request()->password, PASSWORD_DEFAULT);
                $rawdata = array(
                    "name" => request()->name,
                    "surname" => request()->firstname,
                    "email" => request()->email,
                    "nom" => mb_strtolower(request()->localisation, "UTF-8"),
                    "password" => $hash,
                    "id_status" => 1);
                $data = json_encode($rawdata);//encode les données utilisateur

                $opts = array('http' => array(//defini les options de la requete vers l'API
                    'method' => 'POST',
                    'header' => 'Content-type: application/json',
                    'content' => $data
                ));

                $context = stream_context_create($opts);
                $result = file_get_contents('https://h3cate.herokuapp.com/request/users', false, $context);
                $header = self::parseHeaders($http_response_header);

                if($header['reponse_code'] == 200)//verifie qu'il n'y a pas eu d'erreur
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
                //parse le resultat
                $result = str_replace('[', '', $result);
                $result = str_replace(']', '', $result);
                $result = json_decode($result, true);

                if(!password_verify(request()->password, $result['password']))
                {
                    return response('wrong email or password', 404);
                }

                //defini les variables environnement
                $_SESSION['id'] = $result['id'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['status'] = $result['id_status'];

                if(request()->stayconnect === 'true')//si case reste connecter check defini un cookie
                {
                    //ajoute le token dans la bdd
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
                
                    $cookie = cookie('token', session_id(), 432000);
                    return response('success', 200)->cookie($cookie);
                }
                
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
        if(\Cookie::get('token') !== null)//verifie qu'un cookie rester connecter existe
        {
            $result = file_get_contents('https://h3cate.herokuapp.com/request/token/token/'.\Cookie::get('token'));
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
        }

        if(!isset($_SESSION['id']))//si pas connecter ne pas charger les info user
        {
            return response('no id', 200);
        }

        //GET user info
        $result = file_get_contents('https://h3cate.herokuapp.com/request/users/id/'.$_SESSION['id']);
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

    public function logout()
    {
        //supprime le token
        $opts = array('http' => array(
            'method' => 'DELETE',
        ));

        $context = stream_context_create($opts);
        $result = file_get_contents('https://h3cate.herokuapp.com/request/token/id/'.$_SESSION['id'], false, $context);
        $header = self::parseHeaders($http_response_header);

        //unset la seesion et supprime le token
        session_unset();
        return redirect('/')->withCookie(\Cookie::forget('token'));
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
