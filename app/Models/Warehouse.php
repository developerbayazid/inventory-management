<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
   protected $fillable = [
        'name',
        'email',
        'contact',
        'data',
    ];

    protected $casts = [
        'data' => 'array', // automatically converts array <-> JSON
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
