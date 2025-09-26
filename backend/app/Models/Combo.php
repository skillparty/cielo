<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Combo extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'slug',
        'name',
        'subtitle',
        'description',
        'price',
        'compare_at_price',
        'is_active',
        'is_default_recipe_combo',
        'display_order',
        'metadata',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_at_price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_default_recipe_combo' => 'boolean',
        'metadata' => 'array',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'combo_products')
            ->withPivot(['quantity', 'unit', 'unit_price_override', 'display_order', 'is_optional'])
            ->withTimestamps()
            ->orderByPivot('display_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForRecipe($query, $recipeId)
    {
        return $query->where('recipe_id', $recipeId);
    }

    public function scopeDefaultForRecipe($query)
    {
        return $query->where('is_default_recipe_combo', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }

    public function getTotalProductsPrice(): float
    {
        return $this->products->sum(function ($product) {
            $unitPrice = $product->pivot->unit_price_override ?? $product->getCurrentPrice();
            return $unitPrice * $product->pivot->quantity;
        });
    }

    public function getSavingsAmount(): float
    {
        $productsTotal = $this->getTotalProductsPrice();
        return max(0, $productsTotal - $this->price);
    }

    public function getSavingsPercentage(): float
    {
        $productsTotal = $this->getTotalProductsPrice();
        if ($productsTotal <= 0) return 0;
        
        return round(($this->getSavingsAmount() / $productsTotal) * 100, 1);
    }
}
