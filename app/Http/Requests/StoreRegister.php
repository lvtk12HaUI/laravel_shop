<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckMailRule;
use App\Rules\CheckPhoneRule;

class StoreRegister extends FormRequest
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
            'email' => [new CheckMailRule(),'max:50'],
            'password' => 'min:6|max:16',
            'phone' => new CheckPhoneRule()

        ];
    }

    public function messages(){
        return [
            'email.max' => 'Email vượt quá kí tự cho phép',
            'password.min' => 'Mật khẩu phải tối thiểu 6 kí tự',
            'password.max' => 'Mật khẩu không được quá 16 kí tự'
        ];
    }

    
}
