<?php

namespace App\Enums;

final class CommonValidationRules
{
    public const REQUIRED_RULE = "required";
    public const STRING_RULE = "string";
    public const MAX_LESS_THAN_255 = "max:255";
    public const INTEGER_RULE = "integer";
    public const NUMERIC_RULE = "numeric";
    public const NULLABLE_RULE = "nullable";
}
