<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockRequest extends FormRequest
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
            'page_id' => 'exists:pages,id',
            'component_id' => 'exists:components,id',
            'order' => 'numeric|nullable',
            'classes' => 'string|nullable',
            'inner_classes' => 'string|nullable',
            'padding' => 'string|nullable',
        ];
    }
}
