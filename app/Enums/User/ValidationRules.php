<?php

namespace App\Enums\User;

final class ValidationRules
{
    public const EMAIL = 'email';
    public const USER_SHOULD_BE_UNIQUE = 'unique:users';
    public const USER_SHOULD_EXIST = 'exists:users';
    public const CONFIRMED = 'confirmed';
}
