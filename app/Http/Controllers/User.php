<?php

namespace App\Http\Controllers;
use App\Http\Requests\ValidateRegister;
use Illuminate\Http\Request;
use DB;
session_start();
class User extends Controller
{
    public function Lists($start=null) 
    {
        if(!empty($_SESSION["loginToken"])) {
            $length = ceil(DB::table('users')->count()/5);
            $data = [];
            if(!empty($start)) {
                $data = DB::table('users')->select()->offset($start*5)->limit(5)->orderBy('createAt','desc')->get();
            } else {
                $data = DB::table('users')->select()->limit(5)->orderBy('createAt','desc')->get();
            }
            return view('User/lists',compact('data','length','start'));
        } else {
            unset($_SESSION["loginToken"]);
            return redirect('login');
        }
    }
    public function Add () {
        return view('User/add');
    }
    public function postAdd(Request $req,ValidateRegister $val) {
            $data = $req->all();
            $newPassWord = password_hash($data["password"],PASSWORD_DEFAULT);
            $_SESSION['fullname'] =$data["fullname"];
            $_SESSION['activeToken'] = sha1(uniqid().time());
            DB::table('users')->insert([
                [
                    'fullname'=>$data['fullname'],
                    'email'=>$data["email"],
                    'password'=>$newPassWord,
                    'phone'=>$data["phone"],
                    'createAt'=>date('Y-m-d H:i:s'),
                    'updateAt'=>date('Y-m-d H:i:s'),
                    'activeToken' => $_SESSION['activeToken']
                ],
            ]);
            return redirect('user');
         
        
    }
    
    public function Edit($id=null) {
        if(!empty($id)) {
            $data = DB::table('users')->select()->where('id',$id)->first();
            $email = $data->email;
            $fullname = $data->fullname;
            $phone = $data->phone;
            return view('User/getEdit',compact('email','fullname','phone','id'));
        } 
        return redirect('lists');
    }
    public function postUserEdit(Request $req,$id=null) {
        if(!empty($id)) {
            $data = $req->all();
            // dd($data);
            $email = $data['email'];
            $fullname = $data['fullname'];
            $phone = $data['phone'];
            DB::table('users')->where('id',$id)->update([
                'email'=>$email,
                'fullname'=>$fullname,
                'phone'=>$phone
            ]);
            return redirect('/user');
        }

    }
    public function Delete($id=null) {
        DB::table('users')->where('id',$id)->delete();
        return redirect('user');
    }
}
