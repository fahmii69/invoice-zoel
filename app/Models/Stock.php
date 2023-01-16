<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function receiveDetail()
    {
        return $this->hasMany(ReceiveDetail::class, 'quantity');
    }

    public function adjustmentDetail()
    {
        return $this->hasMany(AdjustmentDetail::class, 'quantity');
    }

    public function saleDetail()
    {
        return $this->hasMany(SaleDetail::class, 'quantity');
    }
}
