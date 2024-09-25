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
        'subcategory_id',  // updated this line
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
        'free_shipping',
        'website',
        'video',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'faqs' => 'array',
        'meta_keywords' => 'array',
        'top_stores' => 'boolean',
        'top_brands' => 'boolean',
        'popular_stores' => 'boolean',
        'status' => 'boolean',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function category()
    {
        return $this->hasOneThrough(Category::class, Subcategory::class, 'id', 'id', 'subcategory_id', 'category_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
