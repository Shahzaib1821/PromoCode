<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'status', 'image', 'parent_id'];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'category_store'); // Many-to-many relationship
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}
