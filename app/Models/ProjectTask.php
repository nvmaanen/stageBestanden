<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTask extends Model
{

    use HasFactory;


    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    protected $fillable = [


        "task_id",
        "project_id"

    ];
}
