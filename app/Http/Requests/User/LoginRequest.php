<?php

namespace App\Http\Requests\User;

use App\Enums\CommonValidationRules;
use App\Enums\User\Entries;
use App\Enums\User\Fields;
use App\Enums\User\ValidationRules;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Fields::EMAIL => [
                CommonValidationRules::REQUIRED_RULE,
                CommonValidationRules::STRING_RULE,
                CommonValidationRules::MAX_LESS_THAN_255,
                ValidationRules::EMAIL,
                ValidationRules::USER_SHOULD_EXIST
            ],
            Fields::PASSWORD => [
                CommonValidationRules::REQUIRED_RULE,
                Password::min(Entries::MIN_PASSWORD_LENGTH)
            ]
        ];
    }
}
