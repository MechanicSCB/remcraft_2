<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class BidStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => e($this->name),
            'desc' => e($this->desc),
        ]);

        if(str_contains($this->contact, '@')){
            $this->merge(['email' => $this->contact,]);
        }else{
            $this->merge(['phone' => $this->contact]);
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:250',
            'email' => 'required_without:phone|email:rfc,dns|max:250',
            'phone' => 'required_without:email|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:100',
            'desc' => 'nullable|min:2|max:3500',
            'status' => 'nullable',
            'comment' => 'nullable',
        ];
    }
}
