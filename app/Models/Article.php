<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

Class Article extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable =[
        "title",
        "intro",
        "content",
        "date",
        "ExpDate",
        "image",
        
    ];

}