<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Store extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'tagline',
        'subcategory_id',
        'description',
        'faqs',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'top_stores',
        'top_brands',
        'popular_stores',
        'status',
        'savings',
        'discount',
        'free_shipping',
        'website',
        'video',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'faqs' => 'array',
        'meta_keywords' => 'array',
        'top_stores' => 'boolean',
        'top_brands' => 'boolean',
        'popular_stores' => 'boolean',
        'status' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function tapActivity($activity, string $eventName)
    {
        $activity->properties = $activity->properties->merge(['type' => 'store']);

        if ($eventName === 'created') {
            $activity->description = "Store '{$this->name}' was created";
        } elseif ($eventName === 'updated') {
            $changes = $activity->changes();
            $updatedFields = isset($changes['attributes']) ? array_keys($changes['attributes']) : [];
            $updatedFields[] = 'type';  // Add 'type' to the list of updated fields
            $activity->description = "Updated " . implode(', ', array_unique($updatedFields)) . " for store '{$this->name}'";
        } elseif ($eventName === 'deleted') {
            $activity->description = "Store '{$this->name}' was deleted";
        }
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            SubCategory::class,
            'id',
            'id',
            'subcategory_id',
            'category_id'
        );
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
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
