<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'stocks';


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function receiveDetail(): HasMany
    {
        return $this->hasMany(ReceiveDetail::class, 'quantity');
    }

    public function adjustmentDetail(): HasMany
    {
        return $this->hasMany(AdjustmentDetail::class, 'quantity');
    }

    public function saleDetail(): HasMany
    {
        return $this->hasMany(SaleDetail::class, 'quantity');
    }
}
