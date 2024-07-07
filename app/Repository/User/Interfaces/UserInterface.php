<?php
namespace App\Repository\User\Interfaces;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface UserInterface
{
    public function checkAccessLevel(User $user, int $requiredLevel): bool;
    public function createUser(array $data): JsonResponse;
    public function login(array $data): JsonResponse;
}
