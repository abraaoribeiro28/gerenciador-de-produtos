<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    // Search and sorting
    public ?string $search = null;
    public ?string $sortBy = null;
    public ?string $sortDir = null;

    public function render()
    {
        $products = Product::queryWithFilters(
            $this->sortBy,
            $this->sortDir,
            $this->search
        )->paginate();
        return view('livewire.products', compact('products'));
    }


    /**
     * Handle table sorting logic.
     * Toggles the sort direction if the same column is clicked again.
     *
     * @param string $column
     * @return void
     */
    public function sort(string $column): void
    {
        $this->sortDir = ($this->sortBy === $column && $this->sortDir === 'asc')
            ? 'desc'
            : 'asc';

        $this->sortBy = $column;
    }
}
