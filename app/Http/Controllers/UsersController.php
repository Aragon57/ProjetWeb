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

        $users = new Users;

        $users->name = $request->name;
        $users->firstname = $request->firstname;
        $users->email = $request->email;
        $users->localisation = $request->localisation;
        $users->password = $request->password;
        $users->save();
        

        $_SESSION['email']=$_POST["email"];

        return redirect('/');

    }

     public function connect(Request $requestt)
    {

$user = Users::table('users')->where('email', $request->email, 'password', $request->password )->first();

    
    }


    public function logout(){
        session_unset();
        return redirect('/');
    }
}
