<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NodeRequest extends FormRequest
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
            'page_id' => 'nullable|exists:pages,id',
            'path' => [
                'nullable',
                'string',
                Rule::unique('nodes')->ignore($this->node),
            ],
            'parent_path' => 'nullable|string|exists:nodes,path',
            'href' => 'nullable|string|min:2',
        ];
    }
}
