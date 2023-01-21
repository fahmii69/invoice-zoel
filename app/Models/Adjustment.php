<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adjustment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function adjustmentDetail(): HasMany
    {
        return $this->hasMany(AdjustmentDetail::class, 'adjustment_id');
    }
}
