<?php
namespace App\Http\Controllers;

use App\Http\Requests\Login;
use App\Http\Requests\postForgot;
use App\Http\Requests\ResetPassword;
use App\Http\Requests\ValidateRegister;
use App\Mail\ForgotPassword;
use App\Mail\register;
use DB;
use Illuminate\Http\Request;
use Mail;

session_start();
class Auth extends Controller
{
    public function Active($token = null)
    {
        if (!empty($token)) {
            $dataUser = DB::table('users')->where('activeToken', 'like', "$token")->first();
            if (!empty($dataUser->activeToken)) {
                DB::table('users')->where('activeToken', 'like', "$token")->update(['status' => 1,
                    'activeToken' => null]);

                return redirect('/login')->with('activeKey', 'Kích hoạt tài khoản thành công, bạn có thể đăng nhập ngay bây giờ!');
            } else {
                echo 'Liên kết đã hết hạn';
            }
        } else {
            echo 'Liên kết đã hết hạn';
        }

    }
    public function Forgot()
    {

        return view('Auth/forgot');
    }
    public function postForgot(Request $req, postForgot $val)
    {
        $data = $req->all();
        $email = $data["email"];

        $token = sha1(uniqid() . time());
        $_SESSION['tokenForgotPassword'] = $token;
        DB::table('users')->where('email', 'like', "$email")->update(['forgotToken' => $token]);
        Mail::to($email)->send(new ForgotPassword);
        dd($data);
    }
    public function getLogin()
    {
        if (!empty($_SESSION["loginToken"])) {
            $loginToken = $_SESSION["loginToken"];
            $checkToken = DB::table('logintoken')->select('token')->where('token', 'like', "$loginToken")->first();
            if (!empty($checkToken->token)) {
                return redirect('/user');
            } else {
                unset($_SESSION["loginToken"]);
                return view('Auth/login');
            }
        } else {
            return view('Auth/login');
        }
    }
    public function postLogin(Request $req, Login $val)
    {

        $data = $req->all();
        $email = $data["email"];
        $user = DB::table('users')->select('id')->where('email', 'like', "$email")->first();
        $token = sha1(uniqid() . time());
        $_SESSION['loginToken'] = $token;
        $status = DB::table('logintoken')->insert([
            [
                'token' => $token,
                'userID' => $user->id,
                'createAt' => date('Y-m-d H:i:s'),
            ],
        ]);
        if (!empty($status)) {

            return redirect('/user');
        } else {
            echo 'that bai';
        }
    }

    public function Logout()
    {
        return 'logout';
    }
    public function Register()
    {
        if (!empty($_SESSION["loginToken"])) {

            return redirect('user');
        } else {
            return view('Auth/register');
        }
    }
    public function AddRegister(Request $req, ValidateRegister $val)
    {
        $data = $req->all();
        $newPassWord = password_hash($data["password"], PASSWORD_DEFAULT);
        $_SESSION['fullname'] = $data["fullname"];
        $_SESSION['activeToken'] = sha1(uniqid() . time());
        DB::table('users')->insert([
            [
                'fullname' => $data['fullname'],
                'email' => $data["email"],
                'password' => $newPassWord,
                'phone' => $data["phone"],
                'createAt' => date('Y-m-d H:i:s'),
                'updateAt' => date('Y-m-d H:i:s'),
                'activeToken' => $_SESSION['activeToken'],
            ],
        ]);
        Mail::to($data["email"])->send(new register);
        echo 'thanh cong';
    }
    public function Reset($token = null)
    {
        $token = $token;
        return view('Auth/reset', compact('token'));
    }
    public function PostReset(Request $req, ResetPassword $val, $token = null)
    {
        $token = $token;
        $data = $req->all();
        $password = password_hash($data["password"], PASSWORD_DEFAULT);
        DB::table('users')->where('forgotToken', 'like', "$token")->update(['password' => $password, 'forgotToken' => null]);
    }
}
