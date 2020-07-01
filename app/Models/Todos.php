<?php

namespace App\Models;

use App\Http\Resources\Users;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    protected $fillable =[
        'title','description','status','user_id','status'
    ];
    public function todos()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->hasMany(Users::class);
    }
}
