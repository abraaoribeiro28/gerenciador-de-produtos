<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Returns this category's parent.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Returns child categories of this category.
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Returns products linked to this category.
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    /**
     * Scope to filter categories by search term.
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeFilterBySearch($query, $search)
    {
        $query->with('parent')->where('categories.user_id', auth()->id());

        if (!$search) {
            return $query;
        }

        $query->where(function ($query) use ($search) {
            $query->where('categories.name', 'like', '%' . $search . '%')
                ->orWhereHas('parent', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });

            $normalized = strtolower($search);

            if (str_contains('ativado', $normalized)) {
                $query->orWhere('categories.status', true);
            } elseif (str_contains('desativado', $normalized)) {
                $query->orWhere('categories.status', false);
            }
        });

        return $query;
    }

    /**
     * Builds query with dynamic sorting and search filters.
     * If sorted by 'category', orders by parent category name.
     *
     * @param string|null $sortBy
     * @param string|null $sortDir
     * @param string|null $search
     * @return Builder
     */
    public static function queryWithFilters(?string $sortBy, ?string $sortDir, ?string $search)
    {
        $query = self::query();

        if ($sortBy === 'category') {
            $query->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
                ->orderBy('parent.name', $sortDir)
                ->select('categories.*');
        } else {
            $query->when($sortBy, fn($q) => $q->orderBy($sortBy, $sortDir))
                ->when($sortBy === null, fn($q) => $q->orderBy('created_at', 'desc'));
        }

        $query->withCount('products')
            ->with('parent')
            ->filterBySearch($search);

        return $query;
    }

    /**
     * Ao deletar uma categoria, remove também suas subcategorias diretas.
     *
     * @return void
     */
    protected static function booted(): void
    {
        static::deleting(static function ($category) {
            $category->children()->each(function ($child) {
                $child->delete();
            });

            $category->products()->each(function ($product) {
                $product->delete();
            });
        });
    }
}
