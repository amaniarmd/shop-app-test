<?php

namespace App\Repository\Product\Eloquent;

use App\Enums\CommonFields;
use App\Enums\Product\Entries;
use App\Enums\Product\OutputMessages;
use App\Models\Product\Product;
use App\Repository\BaseRepository;
use App\Repository\Product\Interfaces\ProductInterface;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function index(): JsonResponse
    {
        $products = $this->model::with(Entries::CATEGORY_RELATION, Entries::VARIANT_VALUE_RELATION)->get();

        return $this->jsonResponse($products);
    }

    public function show(int $id): JsonResponse
    {
        $product = $this->find($id, [Entries::CATEGORY_RELATION, Entries::VARIANT_VALUE_RELATION]);

        return $this->jsonResponse($product);
    }

    public function update(array $data, int $id): JsonResponse
    {
        $this->find($id);
        $this->updateChangedAttributes($data);

        return $this->jsonResponse([
            CommonFields::MESSAGE => OutputMessages::PRODUCT_UPDATED
        ]);
    }
}
