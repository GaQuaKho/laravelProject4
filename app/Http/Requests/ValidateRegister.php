<?php

namespace App\Http\Requests;
use DB;
use Illuminate\Foundation\Http\FormRequest;

class ValidateRegister extends FormRequest
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
        $password = $this->password;
         dd($this->phone);
        $email = $this->email;
        $check = DB::table('users')->select('email')->where('email','like',"$email")->first();
        
            return [
                'fullname'=>['required','min:1', 'max:10'],
                'phone' => ['regex:/0[0-9]{9}/'],
                'email' => ['required', function($attribute,$value,$fail) use ($check) {
                    if(!empty($check->email) == $value) {
                        $fail('email da ton tai');
                    }
                }],
                'password'=>['required'],
                'confirm_password'=> ['required',function($attribute, $value,$fail) use ($password){
                    if($value!= $password ) {
                        $fail("Hai mật khẩu không giống nhau, vui lòng nhập lại");
                    }
                }]
            ];
        }
        public function messages() {
            return [
                'fullname.required'=>":attribute bắt buộc nhập",
                'fullname.min'=>":attribute nhiều hơn 1 ký tự",
                'fullname.max'=>":attribute nhỏ hơn 10 ký tự",
                'phone.regex'=>':attribute không hợp lệ',
                'email.requỉed'=>":attribute bắt buộc nhập",
                'password.required'=>":attribute bắt buộc nhập",
                'confirm_password.required'=>"Nhập lại mật khẩu bắt buộc nhập"
            ];
        }
        public function attributes() {
            return [
                'fullname'=>'Họ và tên',
                'phone'=>'Số điện thoại',
                'email'=>'Địa chỉ email',
                'password'=>'Mật khẩu',
            ];
        }
    }
