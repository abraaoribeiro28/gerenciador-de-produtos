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
}
