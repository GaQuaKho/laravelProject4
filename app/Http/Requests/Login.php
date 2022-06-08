<?php

namespace App\Http\Requests;
use DB;
use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $inputMail = $this->email;
        $passwordUser ='';
        $emailUser='';
        $user = DB::table('users')->select('password','email')->where('email','like',"$inputMail")->first();
        if(!empty( $user->password) && !empty($user->email)){
            $passwordUser = $user->password;
            $emailUser = $user->email;

        }
        return [
            'email' => ['required',function ($attribute, $value, $fail) use($emailUser){
                if($value !=$emailUser){
                    $fail('Email không tồn tại');
                }
            }],
            'password' => ['required', function ($attribute, $value, $fail) use($passwordUser){
                if(!password_verify($value,$passwordUser)){
                    $fail('Sai mật khẩu');
                }
            }]
        ];
    }
    public function messages() {
        return [
            'email.required' => 'Email bắt buộc nhập!',
            'password.required' => 'Mật khẩu bắt buộc nhập!'
        ];
    }
}
