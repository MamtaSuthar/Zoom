<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'emp_id'=>'required|max:80|unique:users',
            'name'=>'required|regex:/^[A-Za-z\s]*$/|max:80',  //name should only contains alphabets
            'email'=>'required|email|unique:users|max:100',  //email must be unique and in proper email format
            'password' => 'required|min:8|confirmed',
            'phone'=>'required|digits:10', // phone number must be a number and in between 0-9 
            'location'=>'max:100',
            'country'=>'',
            'state'=>'',
            'city'=>'',
            'pin_code'=>'',
            'dob'=>'required|date|before_or_equal:'.now()->subYears(18)->toDateString(),
            'designation'=>'max:100',
            'blood_group'=>'',
            'about_me'=>'max:300',
            'profile_pic'=>'mimes:jpeg,png,jpg|max:1024' //profile pic format can be jpeg, png, jpg and max size is 1MB
        ];
    }
}
