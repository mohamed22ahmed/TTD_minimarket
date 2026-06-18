<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class EmailOrPhone implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL);

        $isPhone = preg_match('/^\+20(10|11|12|15)\d{8}$/', $value);

        if (! $isEmail && ! $isPhone) {
            $fail('The :attribute must be a valid email address or phone number.');
        }
    }
}
