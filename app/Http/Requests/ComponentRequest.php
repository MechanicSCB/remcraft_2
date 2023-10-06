<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComponentRequest extends FormRequest
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
        $types = ['Html','Gallery','Pile','Masonry','Cost','Calculator','Recommendation'];

        return [
            'title' => 'required|min:3',
            'slug' => [
                'nullable',
                'string',
                'min:3',
                Rule::unique('components')->ignore($this->component),
            ],
            'type' => [
                'required',
                Rule::in($types),
            ],
            'datum' => 'array|nullable',
        ];
    }
}
