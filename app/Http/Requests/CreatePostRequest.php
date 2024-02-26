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
            'image' => ['image', 'required'],
            'title_pos' => ['required'],
            'hook_pos' => ['required'],
            'slug_pos' => ['required', 'min:8', 'regex:/^[0-9a-z\-,:]+$/', Rule::unique('t_posts')->ignore($this->post)],
            'content_pos' => ['string'],
            'cate_pos'=>['required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'slug_pos'=> $this->input('slug') ?: \Str::slug($this->input('title_pos'))
        ]);
    }
}
