<?php

namespace App\Http\Requests\V1;

use App\Rules\UserExist;
use App\Rules\WebSiteExist;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
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
            'website_id' => [
                'required',
                new WebSiteExist,
                Rule::unique('subscribers')->where(function ($query) {
                    return $query
                        ->where('website_id', $this->input('website_id'))
                        ->where('user_id', $this->input('user_id'));
                })
            ],
            'user_id' => [
                'required',
                new UserExist,
            ],
        ];
    }

    public function fields(): array
    {
        return [
            'website_id' => $this->input('website_id'),
            'user_id' => $this->input('user_id'),

        ];
    }
}
