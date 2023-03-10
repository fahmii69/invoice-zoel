<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contract(): HasMany
    {
        return $this->hasMany(Contract::class, 'customer_id');
    }

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }
}
