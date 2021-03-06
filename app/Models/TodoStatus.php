<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TodoStatus extends Model
{
    protected $fillable = [
        'title'
    ];
    //
    public function status()
    {
        return $this->belongsTo(Todos::class);
    }

    public function todo()
    {
        return $this->hasMany(Todos::class);
    }
}
