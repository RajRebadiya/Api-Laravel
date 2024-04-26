<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dbcontroller extends Controller
{
    //
    public function index()
    {
        // return DB::select('select * from students');
        return DB::select('select * from students');
    }
}
