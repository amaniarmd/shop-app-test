<?php
namespace App\Repository\Product\Interfaces;

use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;

interface ProductInterface
{
    public function index(): JsonResponse;
    public function show(int $id): JsonResponse;
    public function update(array $data, int $id): JsonResponse;
}
