<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shop extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function adjustment(): HasMany
    {
        return $this->hasMany(Adjustment::class, 'shop_id');
    }

    public function receive(): HasMany
    {
        return $this->hasMany(Receive::class, 'shop_id');
    }

    public function sales()
    {
        return $this->hasMany(Shop::class, 'shop_id');
    }
}
