<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $append = [
        'contract_product',
        'contract_price',
        'product_with_price'
    ];

    public function getContractProductAttribute()
    {
        return $this->product?->name;
    }

    public function getContractPriceAttribute()
    {
        return rupiah($this->price);
    }

    public function getProductWithPriceAttribute()
    {
        return $this->product?->name . "(" . rupiah($this->price) . ") ";
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
