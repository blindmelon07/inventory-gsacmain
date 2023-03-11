<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'details',
        'description',
        'product_code',
        'main_image',
        'alt_images',
        'price',
        'quantity',
    ];
    protected $casts = [
        'alt_images' => 'array',
    ];
    public function toSearchableArray() {
        $array = $this->toArray();

        $array2 = [
            'categories' => $this->categories->pluck('name')->toArray(),
        ];

        return array_merge($array, $array2);
    }
    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The orders that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class);
    }

}
