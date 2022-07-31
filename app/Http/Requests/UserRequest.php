<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST': {
                    return [
                        'email' => 'required|email|unique:users',
                        'firtsname' => 'required',
                        'lastname' => 'required',
                        'address' => 'required',
                        'birthday' => 'required|date',
                        'password' => 'required',
                        'phone' => 'required|unique:users|numeric|min:10',
                        'avatar' => 'required|image',
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required',
                        'email' => "unique:users,email,$this->id,id",
                        //below way will only work in Laravel ^5.5 
                        'email' => Rule::unique('users')->ignore($this->id),

                        //Sometimes you dont have id in $this object
                        //then you can use route method to get object of model 
                        //and then get the id or slug whatever you want like below:

                        'email' => Rule::unique('users')->ignore($this->route()->user->id),
                    ];
                }
            default:
                break;
        }
    }
}
