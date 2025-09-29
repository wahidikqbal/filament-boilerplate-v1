<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Database\Factories\MenuFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Menu extends Model implements HasMedia
{
    /** @use HasFactory<MenuFactory> */
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'price',
        'discount_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 150, 150)
            ->nonQueued();
    }
}
