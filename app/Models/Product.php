<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{



    public function orders()
    {
        return $this->hasMany(ProductOrder::class, 'product_id');
    }

    protected $fillable = [
        "name",
        "description",
        "price",
        "discount_price",
        "vat",
        "image",

    ];
}
