<?php

namespace App\Models;

use App\Models\Concerns\UploadedFiles;
use App\Models\Contracts\UploadedFilesInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model implements UploadedFilesInterface
{
    use HasFactory, UploadedFiles;

    protected $guarded = [];
    protected $table   = 'products';
    protected $appends = [
        'total_inventory',
        'total_sales_quantity',
    ];

    public function getTotalInventoryAttribute()
    {
        return $this->stocks?->sum('quantity');
    }

    public function getTotalSalesQuantityAttribute()
    {
        return $this->saleDetail?->sum('quantity');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class, 'product_id');
    }

    public function adjustmentDetail(): HasMany
    {
        return $this->hasMany(AdjusmentDetail::class, 'product_id');
    }

    public function receiveDetail(): HasMany
    {
        return $this->hasMany(ReceiveDetail::class, 'product_id');
    }

    public function saleDetail(): HasMany
    {
        return $this->hasMany(SaleDetail::class, 'product_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // public function supplier(): BelongsTo
    // {
    //     return $this->belongsTo(Supplier::class);
    // }

    /**
     * set column from database for upload file
     *
     * @return string
     */
    public function fileColumn(): string
    {
        return 'image';
    }

    /**
     * set uploaded file path
     *
     * @return string
     */
    public function getFilePath(): string
    {
        return 'images';
    }

    /**
     * set uploaded file storage name
     *
     * @return string
     */
    public function getStorageName(): string
    {
        return 'public';
    }
}
