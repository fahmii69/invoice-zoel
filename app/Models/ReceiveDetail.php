<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReceiveDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function receive(): BelongsTo
    {
        return $this->belongsTo(Receive::class, 'receive_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function stock(): BelongsTo
    {
        return $this->belongsTo(Stock::class, 'system_stock');
    }
}
