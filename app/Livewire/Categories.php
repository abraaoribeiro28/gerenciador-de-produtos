<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public ?string $search = null;
    public ?string $sortBy = null;
    public ?string $sortDir = null;
    protected $queryString = ['search'];

    public function render(): View
    {
        $query = Category::query();

        if ($this->sortBy === 'category') {
            $query->leftJoin('categories as parent', 'categories.parent_id', '=', 'parent.id')
                ->orderBy('parent.name', $this->sortDir)
                ->select('categories.*');
        } else {
            $query->when($this->sortBy, fn($q) => $q->orderBy($this->sortBy, $this->sortDir));
        }

        $query->withCount('products')
            ->with('parent')
            ->filterBySearch($this->search);

        return view('livewire.categories', [
            'categories' => $query->paginate(5),
        ]);
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function sort($column): void
    {
        $this->sortDir = $this->sortBy === $column
            ? ($this->sortDir === 'asc' ? 'desc' : 'asc')
            : 'asc';

        $this->sortBy = $column;
    }
}
