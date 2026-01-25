<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array', // automatically converts array <-> JSON
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function products()
    {
        return $this->hasMany(PurchaseProduct::class);
    }
}
