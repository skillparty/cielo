<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Recipe extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'slug',
        'title',
        'subtitle',
        'summary',
        'instructions',
        'prep_time_minutes',
        'cook_time_minutes',
        'difficulty_level',
        'servings',
        'video_url',
        'cover_image',
        'nutrition_facts',
        'metadata',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'nutrition_facts' => 'array',
        'metadata' => 'array',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'recipe_products')
            ->withPivot(['quantity', 'unit', 'is_optional', 'display_order', 'metadata'])
            ->withTimestamps()
            ->orderByPivot('display_order');
    }

    public function combos(): HasMany
    {
        return $this->hasMany(Combo::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByDifficulty($query, $level)
    {
        return $query->where('difficulty_level', $level);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('steps')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(400)
            ->sharpen(10);
    }

    public function getTotalTimeMinutes(): int
    {
        return $this->prep_time_minutes + $this->cook_time_minutes;
    }

    public function getDifficultyLabel(): string
    {
        return match($this->difficulty_level) {
            1 => 'Fácil',
            2 => 'Media',
            3 => 'Difícil',
            default => 'Desconocida',
        };
    }

    public function getRequiredProducts()
    {
        return $this->products()->wherePivot('is_optional', false);
    }

    public function getOptionalProducts()
    {
        return $this->products()->wherePivot('is_optional', true);
    }
}
