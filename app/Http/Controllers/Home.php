<?php

namespace App\Http\Controllers;

use DB;

use  App\Mail\mai1;
use Illuminate\Http\Request;
use Mail;

session_start();

class Home extends Controller
{
  public function Home()
  {
    $product = DB::table('products')->select()->get();
    $token = '';
    if (!empty($_SESSION["loginToken"])) {

      $token = $_SESSION["loginToken"];
    }
    $user_id = DB::table("logintoken")->select()->where("token", "like", "%$token%")->first()->userID;
    return view("Home/home", compact('product', 'user_id'));
  }
  public function Lists()
  {
    return 'lists';
  }
  public function Add()
  {
    return 'add';
  }
  public function Edit()
  {
    return 'edit';
  }
  public function Delete()
  {
    return 'delete';
  }
}
