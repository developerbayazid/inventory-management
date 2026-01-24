<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array', // automatically converts array <-> JSON
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
