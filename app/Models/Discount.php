<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{





    protected $fillable = [
        "product_id",
        "discount",

    ];
}
