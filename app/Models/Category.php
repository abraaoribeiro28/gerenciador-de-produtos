<?php

namespace App\Models;

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

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeFilterBySearch($query, $search)
    {
        $query->with('parent');

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
}
