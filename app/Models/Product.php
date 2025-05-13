<?php

namespace App\Models;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'feature_image',
        'type',
        'has_variant'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'has_variant' => 'boolean',
        ];
    }

    /**
     * Define many-to-many relationship with the Category model
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    /**
     * Define HasMany to relationship with productCategories .
     */
    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class);
    }

    /**
     * Define HasMany to relationship with product Variant .
     */
    public function productVariants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Define function for checking the user's avatar.
     */
    protected function isFeatureImage(string $path): bool
    {
        return Storage::disk(config('filesystems.default'))->exists($path);
    }

    /**
     * Define accessor for image attribute.
     */
    protected function featureImage(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value != null
            ? (
                $this->isFeatureImage($value)
                ? Storage::url($value)
                : asset('assets/images/gallery.png')
            )
            : asset('assets/images/gallery.png')
        );
    }

}
