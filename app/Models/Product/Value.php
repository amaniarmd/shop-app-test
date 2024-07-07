<?php

namespace App\Models\Product;

use App\Enums\Product\Fields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [Fields::NAME, Fields::PROPERTY_ID];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}

