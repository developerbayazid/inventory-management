<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'email',
        'contact',
        'data',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
