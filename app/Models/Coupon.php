<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'coupon_code',
        'store_id',
        'discounted_price',
        'expiry_date',
        'created_date',
        'affiliated_link',
        'status',
        'description',
        'deal_exclusive',
        'verify'
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'created_date' => 'date',
        'status' => 'boolean',
        'deal_exclusive' => 'boolean',
        'verify' => 'boolean',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
