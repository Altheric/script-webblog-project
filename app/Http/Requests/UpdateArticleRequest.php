<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return $this->user()->can('article-update', $this->article);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255|min:3',
            'content' => 'required|max:20000|min:3',
            'category' => 'required|array',
            'category.*' => 'required',
            'image_data' => 'nullable', File::image()->min('1kb')->max('10mb'),
            'image_subtitle' => 'nullable|max:255|min:3'
        ];
    }
}