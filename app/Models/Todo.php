<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Todo extends Model
{
    protected $fillable = [
        'user_id',
        'group_id',
        'completed_by',
        'title',
        'type',
        'is_completed',
    ];


    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeShopping(Builder $query): Builder
    {
        return $query->where('type', 'shopping');
    }

    public function scopeTodo(Builder $query): Builder
    {
        return $query->where('type', 'todo');
    }
}
