<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $guarded = [];
    protected $casts = [
        'data' => 'array', // automatically converts array <-> JSON
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
