<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'sku',
        'slug',
        'name',
        'subtitle',
        'description',
        'preparation_tips',
        'base_price',
        'promo_price',
        'unit_type',
        'unit_quantity',
        'stock',
        'safety_stock',
        'is_featured',
        'is_active',
        'nutrition_facts',
        'metadata',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'promo_price' => 'decimal:2',
        'unit_quantity' => 'decimal:3',
        'stock' => 'decimal:3',
        'safety_stock' => 'decimal:3',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'nutrition_facts' => 'array',
        'metadata' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function recipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'recipe_products')
            ->withPivot(['quantity', 'unit', 'is_optional', 'display_order', 'metadata'])
            ->withTimestamps();
    }

    public function combos(): BelongsToMany
    {
        return $this->belongsToMany(Combo::class, 'combo_products')
            ->withPivot(['quantity', 'unit', 'unit_price_override', 'display_order', 'is_optional'])
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(600)
            ->height(600)
            ->sharpen(10);
    }

    public function getCurrentPrice(): float
    {
        return $this->promo_price ?? $this->base_price;
    }

    public function hasPromotion(): bool
    {
        return !is_null($this->promo_price) && $this->promo_price < $this->base_price;
    }

    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    public function isLowStock(): bool
    {
        return $this->stock <= $this->safety_stock;
    }
}
