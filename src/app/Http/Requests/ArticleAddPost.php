<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleAddPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 認可はミドルウェアで行う
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
            'name' => ['required', 'max:10', 'unique:users', ],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', ],
            'age' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須です',
            'name.max' => '名前は10文字までで入力してください',
            'name.unique' => 'その名前は既に使われています',
            'email.required' => 'emailは必須です',
            'email.email' => 'emailが不正です',
            'email.max' => 'emailは255文字までで入力してください',
            'email.unique' => 'そのemailは既に使われています',
            'age.integer' => '年齢は数字で入力してください',
        ];
    }
}
