<?php

use App\Http\Controllers\apiCall;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\sid;
use App\Http\Controllers\form;
use App\Http\Controllers\Dbcontroller;
use App\Http\Controllers\studentdata;
use App\Http\Controllers\userlogin;
use App\Http\Controllers\showdata;
use App\Http\Controllers\addstudent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('about', '/about');
Route::view('contact', '/contact');
Route::view('info', '/info');

Route::get('user', [Usercontroller::class, 'show']);
Route::get('Studentid/{id}', [sid::class, 'sid']);

Route::view('login', '/form')->middleware('noaccess');

Route::post('users', [form::class, 'getdata']);

Route::view('noaccess', '/noaccess');

Route::group(['middleware' => 'protectedPage'], function () {
    Route::view('about', '/about');
    Route::view('contact', '/contact');
});

Route::get('/db', [Dbcontroller::class, 'index']);

Route::get('/dbdb', [studentdata::class, 'getData']);
Route::get('/apicall', [apicall::class, 'index']);
Route::view('userlogin', '/userlogin');
Route::post('submit', [userlogin::class, 'logindata']);
Route::view('profilepage', '/profilepage');

Route::get('/logout', function () {
    if (session()->has('email')) {
        session()->pull('email');
    }
    return redirect('/userlogin');
});
Route::get('/userlogin', function () {
    if (session()->has('email')) {
        return redirect('/profilepage');
    } else {

        return view('/userlogin');
    }
});

Route::get('/profilepage', function () {
    if (session()->has('email')) {
        return view('/profilepage');
    }
    return redirect('/userlogin');
});

// Route::view('showdata', 'showdata');

Route::get('/showdata', [showdata::class, 'showdata']);
Route::get('/delete/{id}', [showdata::class, 'delete']);
Route::get('/edit/{id}', [showdata::class, 'edit']);
Route::post('edit', [showdata::class, 'update']);
Route::post('addstudent', [showdata::class, 'addstudent']);

Route::view('addstudent', '/addstudent');
Route::get('for-pwd', [showdata::class, 'for_pwd']);
// Route::post('addstudent', [addstudent::class, 'add']);
