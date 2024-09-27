<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'long_description',
        'popular_blog',
        'status',
        'top_blog',
        'featured_blog',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'category_id',
        'faqs',
        'image',
    ];

    protected $casts = [
        'popular_blog' => 'boolean',
        'status' => 'boolean',
        'top_blog' => 'boolean',
        'featured_blog' => 'boolean',
        'meta_keywords' => 'array',
        'faqs' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blogPost) {
            $blogPost->slug = Str::slug($blogPost->name);
        });
    }

    public function blogcategories()
    {
        return $this->belongsTo(BlogCategory::class);
    }

}
