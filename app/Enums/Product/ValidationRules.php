<?php

namespace App\Enums\Product;

final class ValidationRules
{
    public const SHOULD_EXIST_IN_CATEGORIES = "exists:categories,id";
    public const SHOULD_EXIST_IN_PRODUCTS = "exists:products,id";
}
