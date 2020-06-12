<?php

namespace App\Http\Requests\Advertisement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdvertisementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'min:6', 'max:64'],
            'description' => ['sometimes', 'required', 'string', 'min:6', 'max:4096'],
            'price' => ['sometimes', "required", "between:0.01,99999.99"],
        ];
    }
}
