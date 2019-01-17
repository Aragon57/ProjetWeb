<?php

namespace App\Http\Controllers;

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
    }}
