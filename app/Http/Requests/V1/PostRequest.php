<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'website_id' => 'required',
            'title' => 'required'
        ];
    }

    public function fields(): array
    {
        return [
            'website_id' => $this->input('website_id'),
            'title' => $this->input('title'),
            'description' => $this->input('description'),
        ];
    }
}
