<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class addstudent extends Controller
{
    //function 
    function add(Request $req)
    {
        $student = new student();
        $student->fname = $req->firstname;
        $student->lname = $req->lastname;
        $student->save();
        return $student;
    }
}
