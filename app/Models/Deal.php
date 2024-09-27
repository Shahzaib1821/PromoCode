<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Deal extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name',
        'store_id',
        'discounted_price',
        'expiry_date',
        'created_date',
        'affiliated_link',
        'status',
        'sort_order',
        'created_by',
        'updated_by',
        'deleted_by',
        'description',
        'deal_exclusive',
        'verify',
        'top_deal',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'created_date' => 'date',
        'status' => 'boolean',
        'deal_exclusive' => 'boolean',
        'verify' => 'boolean',
        'top_deal' => 'boolean',
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
        $activity->properties = $activity->properties->merge(['type' => 'deal']);

        if ($eventName === 'created') {
            $activity->description = "Deal '{$this->name}' was created";
        } elseif ($eventName === 'updated') {
            $changes = $activity->changes();
            $updatedFields = isset($changes['attributes']) ? array_keys($changes['attributes']) : [];
            $updatedFields[] = 'type';  // Add 'type' to the list of updated fields
            $activity->description = "Updated " . implode(', ', array_unique($updatedFields)) . " for deal '{$this->name}'";
        } elseif ($eventName === 'deleted') {
            $activity->description = "Deal '{$this->name}' was deleted";
        }
    }

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
