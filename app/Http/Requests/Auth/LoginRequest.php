<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Rules\EmailOrPhone;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', new EmailOrPhone()],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $username = $this->input('username');
            $user = User::where('email', $username)->orWhere('phone', $username)->first();

            if (!$user) {
                $validator->errors()->add(
                    'credentials',
                    'User not found with provided email or phone. Please check your credentials.'
                );
            }
        });
    }
}
