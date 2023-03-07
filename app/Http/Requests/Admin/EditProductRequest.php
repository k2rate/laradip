<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
        return [
            'id' => 'required|integer',
            'name' => 'required|string',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'cost' => 'required|integer',
            'count' => 'required|integer',
            'country' => 'required|string',
            'year' => 'required|integer',
        ];
    }
}
