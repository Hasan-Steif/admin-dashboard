<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    return [
        'title'        => 'required|string|max:255',
        'category_id'  => 'required|exists:categories,id',
        'description'  => 'required|string',
        'body'         => 'nullable|string',
        'is_published' => 'sometimes|nullable|boolean',
        'image'        => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:10240',
    ];
}

}
