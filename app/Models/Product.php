<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function adjustmentDetail(): HasMany
    {
        return $this->hasMany(AdjusmentDetail::class, 'product_id');
    }

    public function receiveDetail(): HasMany
    {
        return $this->hasMany(ReceiveDetail::class, 'product_id');
    }

    public function sale(): HasMany
    {
        return $this->hasMany(SalesDetail::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
}
