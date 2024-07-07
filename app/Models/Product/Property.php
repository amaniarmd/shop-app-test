<?php

namespace App\Models\Product;

use App\Enums\Product\Fields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [Fields::NAME, Fields::CATEGORY_ID];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }
}

