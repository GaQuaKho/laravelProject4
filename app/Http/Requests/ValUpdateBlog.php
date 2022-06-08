<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValUpdateBlog extends FormRequest
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
      "title" => [function ($attr, $value, $fail) {
        if (strlen($value) < 1) {
          $fail("Chủ đề phải có độ dài từ 1 trở lên.");
        }
      }],
      "content" => [function ($attr, $value, $fail) {
        if(strlen($value)<1) {
          $fail("Nội dung phải có độ dài từ 1 trở lên.");
        }
      }]
    ];
  }
  public function messages()
  {
    return [];
  }
  public function attributes()
  {
    return [
      "titlte"=>"Chủ đề",
      "Content"=>"Nội dung"
    ];
  }
}
