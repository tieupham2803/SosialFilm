<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieFormRequest extends FormRequest
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
            'runtime' => 'numeric',
            'imdb_score' => 'numeric|min:0|max:10',
            'image' => 'mimes:jpg,jpeg,png,gif,bmp',
            'title' => 'required|unique:movies,title',
        ];
    }
}
