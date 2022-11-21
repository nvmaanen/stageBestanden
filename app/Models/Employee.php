<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    protected $fillable = [
        "name",
        "address",
        "zipcode",
        "telephone",
        "email",


    ];
}
