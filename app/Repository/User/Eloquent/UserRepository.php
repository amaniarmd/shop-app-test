<?php

namespace App\Repository\User\Eloquent;

use App\Enums\CommonFields;
use App\Enums\User\Entries;
use App\Enums\User\Fields;
use App\Enums\User\OutputMessages;
use App\Models\User;
use App\Repository\BaseRepository;
use App\Repository\User\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function checkAccessLevel(User $user, int $requiredLevel): bool
    {
        return $user[Fields::ACCESS_LEVEL] >= $requiredLevel;
    }

    public function createUser(array $data): JsonResponse
    {
        $data[Fields::PASSWORD] = $this->hashPassword($data[Fields::PASSWORD]);

        if(!array_key_exists(Fields::ACCESS_LEVEL, $data)){
            $data[Fields::ACCESS_LEVEL] = Entries::DEFAULT_ACCESS_LEVEL;
        }

        $this->create($data);

        return $this->jsonResponse(
            [CommonFields::MESSAGE => OutputMessages::USER_SUCCESSFULLY_REGISTERED], Response::HTTP_CREATED
        );
    }

    private function hashPassword($password)
    {
        return Hash::make($password);
    }
}
