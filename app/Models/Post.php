<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'published_at',
        'user_id',
        'views',
        'is_published',
        'category_id',
    ];
    protected $casts = [
        'views' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected $attributes = [
        'views' => 0,
        'is_published' => false,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // اسکوپ محلی برای مشاهده ی مقالات منتشر شده
    public function scopePublished($query)
    {
        return $query->where('is_published', true);

    }
    // اکسسور(اضافه کردن فیلد) برای خلاصه کردن مطلب
    public function getExcerptAttribute()
    {
        return substr($this->content, 0, 100)."...";
    }
    // برای بالابردن تعداد بازدید
    public function incrementViewCount()
    {
        $this -> increment('views');
    }
    // برای مشخص کردن اینه که پست ها با چه چیزی جست و جو شوند؟
    public function getRouteKeyName() // به این روش میگن route model binding
    {
        return 'slug';
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeInCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('content', 'like', "%{$term}%");
        });
    }
}
