<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status', 'image'];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
