<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttributeRequest extends FormRequest
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
            'name'        => 'required',
            'slug'        => 'required',
            'decimals'        => 'required',
            'group'        => 'required',
            'chart'        => 'required',
            'field'        => 'required',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}