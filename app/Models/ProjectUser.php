<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

Class ProjectUser extends Model
{

    use HasFactory;

    // protected $table = 'project_users';
    // public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project() 
    {
        return $this->belongsTo(Project::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected $fillable =[
        "role_id",
        "user_id",
        "project_id",
    ];

}