<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'tagline',
        'category_id',
        'description',
        'top_stores',
        'top_brands',
        'popular_stores',
        'status',
        'faqs',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'savings',
        'discount',
        'free_shipping'
    ];

    protected $casts = [
        'faqs' => 'array',
        'meta_keywords' => 'array',
        'top_stores' => 'boolean',
        'top_brands' => 'boolean',
        'popular_stores' => 'boolean',
        'status' => 'boolean',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
