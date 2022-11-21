<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function products()
    {
        return $this->hasMany(ProductOrder::class, 'order_id');
    }



    protected $fillable = [
        "name",
        "email",
        "address",
        "zipcode",
        "residence",
        "total_price",
        "total_vat",
        "total_price_excl"

    ];
}
