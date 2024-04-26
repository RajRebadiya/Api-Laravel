<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class studentdata extends Controller
{
    //
    function getData()
    {
        return Student::all();
    }
}
