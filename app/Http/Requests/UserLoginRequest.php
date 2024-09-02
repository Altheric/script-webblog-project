<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;
class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       //Check if there's a logged in user, since you don't need to log in if you're.. logged in.
       if(Session::get('user_id') == null){
            return true;
        } else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|min:3|max:60',
            'password' => ['required','max:60',Password::min(8)],
        ];
    }
}
