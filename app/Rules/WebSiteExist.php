<?php

namespace App\Rules;

use App\Models\WebSite;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WebSiteExist implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $website = WebSite::query()->where(['id' => $value])->first();
        if (!$website) {
            $fail("WebSite doesn't exists");
        }
    }
}
