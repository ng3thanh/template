<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostRequest extends FormRequest
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
//            'trans.vn.title' => 'required|max:200',
//            'trans.vn.slug' => 'required|max:200',
//            'trans.vn.description' => 'required|max:1000',
//            'trans.vn.content' => 'required|max:20000',
//            'trans.en.title' => 'required|max:200',
//            'trans.en.slug' => 'required|max:200',
//            'trans.en.description' => 'required|max:1000',
//            'trans.en.content' => 'required|max:20000',
//            'image' => 'required'
        ];
    }
}
