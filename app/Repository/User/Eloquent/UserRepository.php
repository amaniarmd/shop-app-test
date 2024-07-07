<?php

namespace App\Repository\User\Eloquent;

use App\Enums\CommonFields;
use App\Enums\User\Entries;
use App\Enums\User\Fields;
use App\Enums\User\OutputMessages;
use App\Jobs\User\SendEmailJob;
use App\Models\User;
use App\Repository\BaseRepository;
use App\Repository\User\Interfaces\UserInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

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

        SendEmailJob::dispatch($data[Fields::EMAIL])->onQueue(Entries::EMAILS_QUEUE_NAME);

        return $this->jsonResponse(
            [CommonFields::MESSAGE => OutputMessages::USER_SUCCESSFULLY_REGISTERED], Response::HTTP_CREATED
        );
    }

    public function login(array $data): JsonResponse
    {
        $token = JWTAuth::attempt($data);

        if (!$token) {
            return $this->jsonResponse([CommonFields::ERROR => OutputMessages::UNAUTHORIZED], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();

        if (!$this->checkAccessLevel($user, Entries::DEFAULT_ACCESS_LEVEL)) {
            return $this->jsonResponse([CommonFields::ERROR => OutputMessages::FORBIDDEN], Response::HTTP_FORBIDDEN);
        }

        return $this->respondWithToken($token);
    }

    private function hashPassword($password)
    {
        return Hash::make($password);
    }

    private function respondWithToken($token)
    {
        return $this->jsonResponse([
            Fields::ACCESS_TOKEN => $token,
            Fields::ACCESS_TOKEN_TYPE => Entries::TOKEN_TYPE,
            Fields::EXPIRES_IN => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}
