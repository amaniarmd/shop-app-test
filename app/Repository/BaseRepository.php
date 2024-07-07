<?php

namespace App\Repository;

use App\Enums\CommonOutputMessages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $data, string $scope = null, array $scopeIds = null)
    {
        $model = $this->model::create($data);

        if (!is_null($scope)) {
            $model->$scope()->attach($scopeIds);
        }

        return $model;
    }

    public function jsonDecode(string $json): array
    {
        return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }

    public function updateAttribute(Model $model, $attribute, $value)
    {
        $model->$attribute = $value;
        $model->save();
    }

    public function updateChangedAttributes(array $attributes)
    {
        $this->model->update($attributes);
        $this->model->save();
    }

    public function find($id, $with = null): Model
    {
        if (!is_null($with)) {
            $this->model->with($with);
        }

        $this->model = $this->model->find($id);

        if (is_null($this->model)) {
            $this->jsonErrorResponse("$this->model not found");
        }

        return $this->model;
    }

    public function jsonErrorResponse($message, int $status = Response::HTTP_NOT_FOUND): HttpResponseException
    {
        throw new HttpResponseException(
            $this->jsonResponse([
                'error' => $message,
            ], $status)
        );
    }

    public function jsonResponse($data, int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    /**
     * @param $attribute
     * @param $value
     * @return Model|null
     */
    public function findByAttribute($attribute, $operator, $value): Model
    {
        $record = $this->model->where($attribute, $operator, $value)->first();

        if (is_null($record)) {
            $this->jsonErrorResponse(CommonOutputMessages::RECORD_NOT_FOUND);
        }

        return $record;
    }

    public function delete(int $id): JsonResponse
    {
        $this->find($id);
        $this->model->delete();

        return $this->jsonResponse([
            'message' => CommonOutputMessages::RECORD_DELETED
        ], Response::HTTP_NO_CONTENT);
    }
}
