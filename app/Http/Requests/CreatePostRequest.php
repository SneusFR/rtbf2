<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostRequest extends FormRequest
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
            'title' => ['required', 'min:8'],
            'image' => ['image', 'required'],
            'titleArt' => ['required'],
            'hook' => ['required'],
            'slug' => ['required', 'min:8', 'regex:/^[0-9a-z\-]+$/', Rule::unique('posts')->ignore($this->post)],
            'content' => ['required'],
            'auteur'=> ['required']

        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug'=> $this->input('slug') ?: \Str::slug($this->input('title'))
        ]);
    }
}
