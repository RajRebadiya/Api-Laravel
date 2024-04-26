<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class form extends Controller
{
    //
    function getdata(request $req)
    {
        $req->validate([
            'email' => 'required | email',
            'password' => 'required | min:6'
        ]);
        return $req->input();
    }
}
