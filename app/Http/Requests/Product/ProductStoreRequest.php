<?php

namespace App\Http\Requests\Product;

use App\Enums\CommonValidationRules;
use App\Enums\Product\Fields;
use App\Enums\Product\ValidationRules;
use App\Http\Requests\BaseRequest;

class ProductStoreRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Fields::NAME => [
                CommonValidationRules::REQUIRED_RULE,
                CommonValidationRules::STRING_RULE,
                CommonValidationRules::MAX_LESS_THAN_255,
            ],
            Fields::CATEGORY_ID => [
                CommonValidationRules::REQUIRED_RULE,
                CommonValidationRules::INTEGER_RULE,
                ValidationRules::SHOULD_EXIST_IN_CATEGORIES
            ],
            Fields::PRICE => [
                CommonValidationRules::NULLABLE_RULE,
                CommonValidationRules::NUMERIC_RULE
            ],
            Fields::STOCK => [
                CommonValidationRules::NULLABLE_RULE,
                CommonValidationRules::INTEGER_RULE
            ]
        ];
    }
}
