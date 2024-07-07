<?php

namespace App\Enums\Product;

final class Entries
{
    public const CATEGORY_RELATION = "category";
    public const VARIANT_VALUE_RELATION = "variants.value";

    public const CATEGORY_NAMES = [
        'mobile',
        'laptop',
        'tv',
        'headphone',
        'watch',
    ];

    public const PRODUCT_NAMES = [
        'samsung',
        'lg',
        'sony'
    ];

    public const PROPERTY_NAMES = [
        'color',
        'size',
        'weight',
        'resolution',
    ];
}
