<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;

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
    return view('Welcome');
});

Route::get('profile/{name?}', [ProfileController::class, 'showProfile']);

Route::get('home', [HomeController::class, 'showWelcome']);
Route::get('about', [AboutController::class, 'showAbout']);

//Route::get('about',function () {
 //   return 'About Content';
//});

Route::get('about/{theSubject}',[AboutController::class, 'showSubject']);

Route::get('about/directions',array('as' => 'directions', function(){
    $theURL = URL::route('directions');
    return 'Directions go here';
}));
Route::any('submit-form',function(){
    return 'Process Form';
});
//Route::get('about/{theSubject}',function ($theSubject){
  //  return $theSubject.' content goes here';
//});
Route::get('about/classes/{theArt}/{thePrice}',function($theArt, $thePrice){
    return "The Product: $theArt and $thePrice";
});
Route::get('where',function () {
    return Redirect::route('directions');
});
Route::get('/insert',function (){
    DB::insert('insert into posts(title,body,is_admin) values(?,?,?)',['PHP with Laravel','Laravel is the best framework !',0]);
    return 'done';
});
Route::get('/read',function (){
    $result = DB::select('select * from posts where id = ?',[1]);
 //   return $result;
    foreach ($result as $post){
        return $post->title;
    }
});
Route::get('update',function (){
    $updated = DB::update('update posts set title = "New title lmao" where id > ?',[1]);
    return $updated;
});
Route::get('delete',function (){
    $deleted = DB::delete('delete from posts where id = ?',[3]);
    return $deleted;
});
