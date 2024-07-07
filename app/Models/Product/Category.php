<?php

namespace App\Models\Product;

use App\Enums\Product\Fields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [Fields::NAME];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}

