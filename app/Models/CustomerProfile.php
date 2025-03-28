<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProductReview;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'cus_name',
        'cus_add',
        'cus_city',
        'cus_state',
        'cus_postcode',
        'cus_country',
        'cus_phone',
        'cus_fax',
        'ship_name',
        'ship_add',
        'ship_city',
        'ship_state',
        'ship_postcode',
        'ship_country',
        'ship_phone',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function productReview(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }
}
