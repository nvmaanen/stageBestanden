<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    public function employees()
    {
        return $this->hasMany(CompanyEmployee::class);
    }
    public function projects()
    {
        return $this->hasMany(CompanyProject::class);
    }



    protected $fillable = [
        "name",
        "address",
        "zipcode",
        "telephone",
        "email",


    ];
}
