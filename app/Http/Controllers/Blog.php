<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\CommentBlog;
use App\Http\Requests\ValUpdateBlog;
session_start();

class Blog extends Controller
{
  public function getBlog()
  {
    $token = $_SESSION['loginToken'];
    $dataLoginToken = DB::table('logintoken')->select('userID')->where('token', 'like', '%' . $token . '%')->first();

    $dataUser = DB::table('users')->select('fullname')->where('id', $dataLoginToken->userID)->first();

    $dataBlog = DB::table('blog')->select('createAt', 'content', 'fullname', 'title', 'id')->orderBy('createAt', 'desc')->get();
    $ten = $dataUser->fullname;
    return view('Blog/GetBlog', compact('ten', 'dataBlog'));
  }
  public function postBLog(Request $req)
  {
    if (!empty($_SESSION['loginToken'])) {
      $req = $req->all();
      $dataLoginToken = DB::table('logintoken')->select('userID')->where('token', 'like', '%' . $_SESSION['loginToken'] . '%')->first();
      $dataUser =  DB::table('users')->select('fullname')->where('id', $dataLoginToken->userID)->first();
      $check = DB::table('blog')->insert([[
        'users_id' => $dataLoginToken->userID,
        'content' => $req['content'],
        'createAt' => date('Y-m-d H:i:s'),
        'fullname' => $dataUser->fullname,
        'title' => $req['title']
      ]]);
      if ($check) {
        $token = $_SESSION['loginToken'];
        $dataLoginToken = DB::table('logintoken')->select('userID')->where('token', 'like', '%' . $token . '%')->first();

        $dataUser = DB::table('users')->select('fullname')->where('id', $dataLoginToken->userID)->first();

        $dataBlog = DB::table('blog')->select('createAt', 'content', 'fullname', 'title', 'id')->get();
        $ten = $dataUser->fullname;
        return view('Blog/GetBlog', compact('ten', 'dataBlog'));
      } else {
        return view('Error/Error');
      }
    } else {
      return view('Error/Error');
    }
  }
  public function deleteBlog(Request $req, $id = null)
  {
    $req = $req->all();
    $check = DB::table('blog')->where('id', $id)->delete();
    $checkCommentBlog = DB::table('comment_blog')->where('blog_id', $id)->delete();
    if ($check && $checkCommentBlog) {
      return redirect('blog');
    } else {
      return view('/Error/Error');
    }
  }
  public function getDetailBlog(Request $req, $id = null)
  {
    if (!empty($id)) {
      $data = DB::table('blog')->select()->where('id', $id)->first();
      $user = DB::table('users')->select()->where('id', $data->users_id)->first();
      $allBlog = DB::table('blog')->select()->orderBy('createAt', 'desc')->limit(12)->get();
      $commentBlog = DB::table('comment_blog')->select()->where('blog_id', $id)->orderBy('createAt', 'desc')->get();

      if (!empty($data) && !empty($user) && !empty($allBlog) && !empty($commentBlog)) {
        return view('Blog/DetailBlog', compact('data', 'user', 'allBlog', 'commentBlog'));
      } else {
        return view('Error/Error');
      }
    } else {
      return view('Error/Error');
    }
  }
  public function getEditDetailBlog(Request $req, $id = null)
  {
    if (!empty($id)) {
      $data = DB::table("blog")->select()->where("id", $id)->first();
      if (!empty($data)) {
        return view("Blog/EditDetailBlog", compact('data'));
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function postEditDetailBlog(Request $req,ValUpdateBlog $val, $id = null)
  {
    if (!empty($id) && !empty($req)) {
      $req = $req->all();
      $check = DB::table("blog")->where("id", $id)->update([
        "title" => $req["title"],
        "content" => $req["content"],
        "createAt" => date("Y-m-d H:i:s")
      ]);
      if (!empty($check)) {
        return redirect("/blog/detail-blog/$id");
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function commentDetailBlog(Request $req, CommentBlog $val)
  {
    $req = $req->all();
    if (!empty($req)) {
      $check = DB::table('comment_blog')->insert([[
        'user_id' => $req["user_id"],
        'fullname' => $req["fullname"],
        'content' => $req["content"],
        "blog_id" => $req["blog_id"],
        "createAt" => date("Y-m-d H:i:s")
      ]]);
      if (!empty($check)) {
        $blogID = $req["blog_id"];
        return redirect("/blog/detail-blog/$blogID");
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
  public function getDeleteComment(Request $req, $id = null, $page = null)
  {
    if (!empty($id) && !empty($page)) {

      $check = DB::table("comment_blog")->where('id', $id)->delete();
      if (!empty($check)) {
        return redirect("/blog/detail-blog/$page");
      } else {
        return view('Error/Error');
      }
    } else {
      return view('Error/Error');
    }
  }
  public function getEditComment(Request $req, $id = null, $page = null)
  {
    if (!empty($id) && !empty($page)) {
      $data = DB::table('comment_blog')->select()->where('id', $id)->first();
      return view('Blog/EditComment', compact('id', 'page', 'data'));
    } else {
      return view("Error/Error");
    }
  }
  public function postEditComment(Request $req, $id = null, $page = null)
  {
    if (!empty($id) && !empty($page)) {
      $req = $req->all();
      $check = DB::table("comment_blog")->where("id", $id)->update([
        "content" => $req["content"],
        "createAt" => date("Y-m-d H:i:s")
      ]);
      if (!empty($check)) {
        return redirect("/blog/detail-blog/$page");
      } else {
        return view("Error/Error");
      }
    } else {
      return view("Error/Error");
    }
  }
}
