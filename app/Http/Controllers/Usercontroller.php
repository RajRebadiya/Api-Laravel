<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Usercontroller extends Controller
{
    //

    function show()
    {
        $data = ['Raj', 'Keyr', 'vinay', 'kumar', 'kumari'];
        return view('user', ['name' => $data] , ['nnn' => 'Hitesh']);
    }
}
