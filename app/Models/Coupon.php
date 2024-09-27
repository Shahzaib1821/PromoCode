<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Coupon extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'coupon_code',
        'store_id',
        'discounted_price',
        'expiry_date',
        'created_date',
        'affiliated_link',
        'status',
        'sort_order',
        'description',
        'deal_exclusive',
        'verify',
        'created_by',
        'updated_by',
        'deleted_by',
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
        $activity->properties = $activity->properties->merge(['type' => 'coupon']);

        if ($eventName === 'created') {
            $activity->description = "Coupon '{$this->code}' was created";
        } elseif ($eventName === 'updated') {
            $changes = $activity->changes();
            $updatedFields = isset($changes['attributes']) ? array_keys($changes['attributes']) : [];
            $updatedFields[] = 'type';  // Add 'type' to the list of updated fields
            $activity->description = "Updated " . implode(', ', array_unique($updatedFields)) . " for coupon '{$this->code}'";
        } elseif ($eventName === 'deleted') {
            $activity->description = "Coupon '{$this->code}' was deleted";
        }
    }

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

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
