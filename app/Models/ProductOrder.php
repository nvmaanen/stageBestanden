<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{



    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected $fillable = [
        "product_id",
        "order_id",
        "name",
        "price",
        "discount_price",
        "vat",
        "quantity",

    ];
}
