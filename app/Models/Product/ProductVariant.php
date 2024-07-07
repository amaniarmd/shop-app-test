<?php

namespace App\Models\Product;

use App\Enums\Product\Fields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [Fields::PRODUCT_ID, Fields::VALUE_ID, Fields::PRICE, Fields::STOCK];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function value()
    {
        return $this->belongsTo(Value::class);
    }
}
