<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use mail;

class showdata extends Controller
{
    //
    function showdata()
    {
        $data = product::paginate(10);
        return view('showdata', ['data' => $data]);
    }

    function delete($id)
    {
        $product = new product;
        $product->find($id)->delete();
        return redirect('/showdata');
    }

    function addstudent(Request $req)
    {
        $product = new product;
        $product->fname = $req->firstname;
        $product->lname = $req->lastname;
        $product->save();
        return redirect('/showdata');
    }

    function edit($id)
    {

        $data = product::find($id);
        return view('edit', ['data' => $data]);
    }

    function update(Request $req)
    {


        $product = product::find($req->id);
        $product->fname = $req->firstname;
        $product->lname = $req->lastname;
        $product->save();
        return redirect('/showdata');
    }
   
}
