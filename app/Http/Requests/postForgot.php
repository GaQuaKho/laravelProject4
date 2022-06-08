<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use DB;
class postForgot extends FormRequest
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
        $email = $this->email;
        $DB = DB::table('users')->select('email')->where('email','like',"$email")->first();
        $emailDB = '';
        if(!empty($DB->email)){

            $emailDB = $DB->email;
        }
        return [
            'email'=>[function($attribute,$value,$fail) use($emailDB) {
                if(empty($emailDB)){
                    $fail('Khong co email trong he thong');
                }
            }]
        ];
    }
}
