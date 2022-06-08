<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentBlog extends FormRequest
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

      return [
         'content'=>['min:1']
      ];
   }
   public function messages()
   {
      return [
         'content.min'=>":attribute phải ít nhất 1 ký tự."
      ];
   }
   public function attributes()
   {
      return [
         "content"=>"Nội dung"
      ];
   }
}
