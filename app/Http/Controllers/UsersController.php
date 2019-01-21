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
     public function store(Request $request)
    {
        // Validate the request...
        if($request->password == $request->password_confirmation)
        {
            if($request->password = "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$")
            {

            
                $hash = password_hash($request->password, PASSWORD_DEFAULT);
                $rawdata = array(
                    "name" => $request->name,
                    "surname" => $request->firstname,
                    "email" => $request->email,
                    "nom" => $request->localisation,
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

                if($result)
                {
                    return 'true';
                }
                else
                {
                    return 'false';
                }

            }
            else
            {
                return false;
            }
        }
        return redirect('/');

        return 'false';
    }

     public function connect(Request $requestt)
    {

$connect = Users::where("email",$requestt->emailc)
                ->where("password",$requestt->passwordc)
                ->first();
    
    if($connect){
        $_SESSION['id']=$connect["id_user"];
        $_SESSION['status']=$connect["id"];
        $_SESSION['email']=$requestt->emailc;
      

          return redirect('/');

    }
    else{
                Print_r($connect);

    }


    }


    public function logout(){
        session_unset();
        return redirect('/');
    }



function parseHeaders( $headers )
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
