<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'category_id',
    ];

    /**
     * Gets the category the product belongs to.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Gets all files associated with this product.
     *
     * @return BelongsToMany
     */
    public function archives(): BelongsToMany
    {
        return $this->belongsToMany(Archive::class, 'archive_product')
            ->withTimestamps();
    }


    /**
     * Scope to filter products by search term.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeFilterBySearch($query, $search): Builder
    {
        $query->with('category')->where('products.user_id', auth()->id());

        if (!$search) {
            return $query;
        }

        $query->where(function ($query) use ($search) {
            $query->where('products.name', 'like', '%' . $search . '%')
               ->orWhere('products.stock', 'like', '%' . $search . '%')
               ->orWhereHas('category', function ($query) use ($search) {
                  $query->where('name', 'like', '%' . $search . '%');
               });

            $normalized = strtolower($search);

            if (str_contains('ativado', $normalized)) {
                $query->orWhere('products.status', true);
            } elseif (str_contains('desativado', $normalized)) {
                $query->orWhere('products.status', false);
            }
        });

        return $query;
    }

    /**
     * Builds query with dynamic sorting and search filters.
     * If sorted by 'products', orders by parent category name.
     *
     * @param string|null $sortBy
     * @param string|null $sortDir
     * @param string|null $search
     * @return Builder
     */
    public static function queryWithFilters(?string $sortBy, ?string $sortDir, ?string $search): Builder
    {
        $query = self::query();

        if ($sortBy === 'category') {
            $query->join('categories', 'categories.id', '=', 'products.category_id')
                ->orderBy('categories.name', $sortDir)
                ->select('products.*');
        } else {
            $query->when($sortBy, fn($q) => $q->orderBy("products.{$sortBy}", $sortDir))
                ->when($sortBy === null, fn($q) => $q->orderBy('products.created_at', 'desc'));
        }

        $query->filterBySearch($search);

        return $query;
    }
}
