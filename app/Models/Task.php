<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Task extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'tasks';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function project()
    {
        return $this->belongsTo(Project::class);
    }


    protected $fillable = [
        'task',
        'description',
        'project_id',
        'user_id',
        'startDate',
        'endDate',

    ];
}
