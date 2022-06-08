<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\PayProduct;

session_start();
class Cart extends Controller
{
  public function getCart(Request $req)
  {
    $loginToken = "";
    if (!empty($_SESSION["loginToken"])) {
      $loginToken = $_SESSION["loginToken"];
      $user_id = DB::table("logintoken")->select()->where("token", "like", "%$loginToken%")->first()->userID;
      $cart = DB::table("cart")->select()->where("user_id", $user_id)->get();
      if (!empty($cart)) {

        return view("Cart/GetCard", compact('cart'));
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function postAddProduct(Request $req)
  {
    if (!empty($req)) {
      $req = $req->all();
      $check = DB::table("cart")->insert([[
        "user_id" => $req["user_id"],
        "title" => $req["title"],
        "price" => $req["price"],
        "img" => $req["image"],
        "createAt" => date("Y-m-d H:i:s")
      ]]);
      if (!empty($check)) {
        return redirect('/');
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function postDeleteProduct(Request $req)
  {
    if (!empty($req) && !empty($_SESSION["loginToken"])) {
      $req = $req->all();
      $check = DB::table("cart")->where("id", $req["id"])->delete();
      if (!empty($check)) {
        return redirect("/cart");
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function postPayProduct(Request $req, PayProduct $val)
  {
    if (!empty($_SESSION["loginToken"])) {
      $req = $req->all();
      $data = array_splice($req, 0, count($req) - 3);
      foreach ($data as $item) {
        $subData = DB::table("cart")->select()->where("id", $item)->first();
        // dd($subData);
        $checkUpdateHistoryCart = DB::table("history_cart")->insert([
          "user_id" => $subData->user_id,
          "title" => $subData->title,
          "price" => $subData->price,
          "img" => $subData->img,
          "address" => $req["address"],
          "createAt" => date("Y-m-d H:i:s")
        ]);
        $checkDeleteCart = DB::table("cart")->where("id", $item)->delete();
        if (empty($checkUpdateHistoryCart) || empty($checkDeleteCart)) {
          return view("Error/Error");
        }
      }
      return redirect("/cart/history-product");
    } else {
      return view("Error/Error");
    }
  }
  public function getHistoryProduct(Request $req)
  {
    if (!empty($_SESSION["loginToken"])) {
      $loginToken = $_SESSION["loginToken"];
      $user = DB::table("logintoken")->select()->where("token", "like", "%$loginToken%")->first();
      $userID = $user->userID;
      $data = DB::table("history_cart")->select()->where("user_id", $userID)->orderBy("createAt",'desc')->get();
      if (!empty($data)) {
        return view("Cart/Historycart", compact('data'));
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
}
