<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
   public function rules(): array
{
    return [
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string',
        'body' => 'nullable|string',
        'image' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:10240',
        'slug' => [
            'required',
            Rule::unique('posts', 'slug')->ignore($this->post->id), 
        ],
    ];
}
}
