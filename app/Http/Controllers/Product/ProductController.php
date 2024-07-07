<?php

namespace App\Http\Controllers\Product;

use App\Http\Requests\Product\ProductShowOrDestroyRequest;
use App\Http\Requests\Product\ProductStoreRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use App\Repository\Product\Interfaces\ProductInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return $this->productRepository->index();
    }

    public function store(ProductStoreRequest $request)
    {
        return $this->productRepository->create($request->validated());
    }

    public function show(ProductShowOrDestroyRequest $request, $id)
    {
        return $this->productRepository->show($id);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        return $this->productRepository->update($request->validated(), $id);
    }

    public function destroy(ProductUpdateRequest $request, $id)
    {
        return $this->productRepository->delete($id);
    }
}

