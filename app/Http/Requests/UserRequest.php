<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            // 'role' => 'required|not_in:0',
            'first_name' => 'required|max:191',
            'middle_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            // 'username' => 'required|max:191|unique:users',
            // 'email' => 'required|email|max:191|unique:users',
            // 'password' => 'required|min:6|confirmed',
        ];
    }
}
