<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    public function users()
    {
        return $this->hasMany(ProjectUser::class);
    }
    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }



    protected $fillable = [
        "title",
        "intro",
        "description",
        "image",
        "user_id",
        "StartDate",
        "EndDate",

    ];
}
