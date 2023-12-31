<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GalleryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'slug' => [
                'nullable',
                'string',
                'min:3',
                Rule::unique('galleries')->ignore($this->gallery),
            ],
            'component_id' => 'exists:components,id|nullable',
            'order' => 'numeric|nullable|min:0',
        ];
    }
}
