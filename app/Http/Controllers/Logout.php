<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
session_start();
class Logout extends Controller
{
    public function LogOUT() {
        if(!empty($_SESSION["loginToken"])){
            $token = $_SESSION["loginToken"];
            DB::table('logintoken')->where("token",'like',"$token")->delete();
            unset($_SESSION["loginToken"]);
            return redirect('login');
        } else {
            return redirect('login');
        }
    }
}
