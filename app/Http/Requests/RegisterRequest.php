<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:4',
            'prénom' => 'required|string',
            'nom' => 'required|string',
            'adresse' => 'required|string',
            'cp' => 'nullable|numeric|min:1000',
            'ville' => 'nullable|string',
            'pays' => 'nullable|string',
            'pref'=> 'nullable',
            'tel' => 'nullable|string',
            'role' => 'nullable|string',
            'genre' => 'nullable|string'
        ];
    }

}
