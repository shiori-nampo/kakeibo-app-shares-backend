<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    protected $fillable = [
        'name'
    ];
}
