<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userlogin extends Controller
{
    //
    function logindata(request $req)
    {
        return $req->file('file')->store('img');

        // $data =  $req->input('file');
        // $req->session()->put('email', $data);
        // // return $req->input();
        // return redirect('profilepage');
    }
}
