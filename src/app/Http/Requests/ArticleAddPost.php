<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;
use Illuminate\Contracts\Validation\Validator as ValidatorInterface;

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

    public function validator(ValidationFactory $factory): ValidatorInterface
    {
        // ASCII英字のみの独自バリデータを追加
        // 汎用のものはクラスに切り出した方がよい
        Validator::extend('ascii_alpha', function ($attr, $value, $params) {
            return preg_match('/\A[a-zA-Z]+\z/', $value);
        });

        return $this->createDefaultValidator($factory);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:10', 'unique:users', 'ascii_alpha'],
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

            'name.ascii_alpha' => '名前は半角アルファベットで入力してください',
        ];
    }
}
