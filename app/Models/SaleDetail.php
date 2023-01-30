<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $append = [
        'product_list',
        'name_with_qty',
    ];

    public function getProductListAttribute()
    {
        return $this->product?->name;
    }

    public function getNameWithQtyAttribute()
    {
        return $this->product?->name . "(" . number_format($this->quantity) . ") ";
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
