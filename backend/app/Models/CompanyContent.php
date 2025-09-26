<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CompanyContent extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'section_key',
        'title',
        'subtitle',
        'content',
        'gallery_images',
        'video_url',
        'location_data',
        'display_order',
        'is_published',
        'metadata',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'location_data' => 'array',
        'is_published' => 'boolean',
        'metadata' => 'array',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeBySection($query, $sectionKey)
    {
        return $query->where('section_key', $sectionKey);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('title');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('hero')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(200)
            ->sharpen(10);

        $this->addMediaConversion('medium')
            ->width(800)
            ->height(600)
            ->sharpen(10);
    }
}
