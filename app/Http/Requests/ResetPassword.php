<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
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
        $confirm_password = $this->confirm_password;
        return [
            'password'=> [function($attribute,$value,$fail) use($confirm_password){
                if($value != $confirm_password){
                    $fail('hai mat khau khong giong nhau');
                }
            }]
        ];
    }
}
