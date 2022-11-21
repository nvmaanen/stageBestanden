<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProject extends Model
{

    use HasFactory;


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    protected $fillable = [


        "company_id",
        "project_id"

    ];
}
