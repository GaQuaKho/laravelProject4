<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

session_start();

class Product extends Controller
{
  public function AddProduct(Request $req)
  {
    return view('/Product/AddProduct');
  }
  public function PostAddProduct(Request $req)
  {
    if (!empty($req)) {

      $req = $req->all();
      $check = DB::table('products')->insert([[
        "title" => $req["title"],
        "price" => $req["price"],
        "description" => $req["description"],
        "category" => $req["category"],
        "image" => $req["image"],
        "rate" => $req["rate"],
        "count" => $req["count"]
      ]]);
      if ($check) {
        return redirect('/');
      } else {
        echo "that bai";
      }
    }
  }
  public function getDetailProduct(Request $req, $id = null)
  {
    if (!empty($req) && !empty($id) && !empty($_SESSION["loginToken"])) {
      $token = $_SESSION["loginToken"];
      $user = DB::table("logintoken")->select()->where("token","like","%$token%")->first();

 
      $user_id = $user->userID;
      $data = DB::table("products")->select()->where("id", $id)->first();

      if (!empty($data) && !empty($data)) {
        return view("Product/GetDetailProduct",compact("data","user_id"));
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function DeleteProduct(Request $req, $id = null)
  {
    if (!empty($id)) {
      $check = DB::table('products')->where('id', '=', $id)->delete();
      if (!empty($check)) {
        return redirect('/');
      } else {
        echo 'Xóa thất bại';
      }
    } else {
      echo 'Xóa thất bại';
    }
  }
  public function getEditProduct(Request $req, $id = null)
  {
    if (!empty($id)) {
      $data = DB::table('products')->select()->where('id', $id)->first();
      return view('Product/EditProduct', compact('data'));
    } else {
      echo 'Khong co id';
    }
  }
  public function postEditProduct(Request $req, $id = null)
  {
    if (!empty($id)) {
      $req = $req->all();

      $check = DB::table('products')->where('id', $id)->update([
        "title" => $req["title"],
        "price" => $req["price"],
        "description" => $req["description"],
        "category" => $req["category"],
        "image" => $req["image"],
        "rate" => $req["rate"],
        "count" => $req["count"]
      ]);
      if (!empty($check)) {
        return redirect('/');
      } else {
        echo "sua san pham that bai";
      }
    } else {
      echo 'khong ton tai id';
    }
  }
}
