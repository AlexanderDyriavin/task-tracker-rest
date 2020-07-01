<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Todos extends Model
{
    protected $fillable =[
        'title','description','status','user_id','status'
    ];
    public function updateStatus($id,$status)
    {
        $todo = Todos::findOrFail($id);
        $todo->status = $status;
        $todo->save();
        return $todo;
    }
    public function updateAssignedUser($id,$userId)
    {
        $todo = Todos::findOrfail($id);
        $todo->user_id = $userId;
        $todo->save();
        return $todo;
    }
    public function todos()
    {
        return $this->belongsTo(User::class);
    }
    public function status()
    {
        $this->hasOne(TodoStatus::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
