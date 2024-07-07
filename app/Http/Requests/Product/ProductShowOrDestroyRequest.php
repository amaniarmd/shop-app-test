<?php

namespace App\Http\Requests\Product;

use App\Enums\CommonValidationRules;
use App\Enums\Product\Fields;
use App\Enums\Product\ValidationRules;
use App\Http\Requests\BaseRequest;

class ProductShowOrDestroyRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Fields::ID => [
                CommonValidationRules::INTEGER_RULE,
                ValidationRules::SHOULD_EXIST_IN_PRODUCTS
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            Fields::ID => $this->route(Fields::ID)
        ]);
    }
}
