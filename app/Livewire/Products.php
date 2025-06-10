<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Products extends Component
{
    use WithPagination;

    // Search and sorting
    public ?string $search = null;
    public ?string $sortBy = null;
    public ?string $sortDir = null;

    // Modal visibility control
    public bool $showModalForm = false;
    public bool $showModalDelete = false;

    // Form data
    public bool $status = true;
    public ?string $name = null;
    public ?string $slug = null;
    public ?string $price = null;
    public ?int $stock = 0;
    public ?string $description = null;
    public ?int $category_id = null;

    // Identifiers for edit and delete actions
    public ?int $productId = null;
    public ?Product $productToDelete = null;

    /**
     * Render the Livewire component view with filtered products
     *
     * @return View
     */
    public function render(): View
    {
        $products = Product::queryWithFilters(
            $this->sortBy,
            $this->sortDir,
            $this->search
        )->paginate();

        return view('livewire.products', compact('products'));
    }

    /**
     * Get the validation rules for the category form.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'slug' => [Rule::unique('products', 'slug')->ignore($this->productId)],
            'price' => ['required'],
            'stock' => ['required'],
            'status' => ['boolean'],
            'description' => ['max:999'],
        ];
    }

    /**
     * Custom validation messages for the product form.
     *
     * @return array<string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O campo nome não deve ter mais de 255 caracteres.',
            'price.required' => 'O campo preço é obrigatório.',
            'stock.required' => 'O campo estoque é obrigatório.',
            'category_id.exists' => 'A categoria selecionada não existe na base de dados.',
            'slug.unique' => 'O campo nome já existe.',
            'description.max' => 'O campo nome não deve ter mais de 255 caracteres.',
        ];
    }

    /**
     * Open the product form modal and reset its state.
     *
     * @return void
     */
    public function openModal(): void
    {
        $this->resetForm();
        $this->showModalForm = true;
    }

    /**
     * Populates the form with data from the selected product for editing.
     * Also triggers a modal and dispatches the 'set-property' event to update reactive components.
     *
     * @param  Product $product
     * @return void
     */
    public function edit(Product $product): void
    {
        $this->resetForm();
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->price = 'R$ ' . number_format((float) $product->price, 2, ',', '.');
        $this->stock = $product->stock;
        $this->productId = $product->id;
        $this->status = $product->status;
        $this->description = $product->description;
        $this->category_id = $product->category_id;

        $this->showModalForm = true;

        $this->dispatch('set-property', [
            'id' => $product->category_id,
            'name' => $product->category?->name,
        ]);
    }

    /**
     * Validate and save the product.
     * Creates a new record or updates the existing one based on productId.
     *
     * @return void
     */
    public function save(): void
    {
        $validated = $this->validate();

        $validated['price'] = $this->sanitizePrice($validated['price']);

        Product::updateOrCreate(
            ['id' => $this->productId],
            [...$validated, 'user_id' => auth()->id()]
        );

        $this->resetForm();
        $this->showModalForm = false;
    }

    /**
     * Reset all product form-related fields to their default values.
     *
     * @return void
     */
    protected function resetForm(): void
    {
        $this->reset([
            'name',
            'slug',
            'price',
            'stock',
            'status',
            'description',
            'category_id',
            'productId'
        ]);

        $this->dispatch('reset-form');
    }

    /**
     * Prepare and open the delete confirmation modal for the selected category.
     *
     * @param Product $product
     * @return void
     */
    public function confirmDelete(Product $product): void
    {
        $this->productToDelete = $product;
        $this->showModalDelete = true;
    }

    /**
     * Delete the selected category and close the confirmation modal.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->productToDelete->delete();
        $this->productToDelete = null;
        $this->showModalDelete = false;
    }

    /**
     * Automatically generate a slug when the name is updated.
     *
     * @return void
     */
    public function updatedName(): void
    {
        $this->slug = Str::slug($this->name, '-');
    }

    /**
     * Handles the 'searching' event by querying categories that match the search string.
     * Sends back up to 10 results to the component via 'search-response' event.
     *
     * @param string $search The search term typed by the user
     * @return void
     */
    #[On('searching')]
    public function searchCategory(string $search): void
    {
        $categories = Category::where('name', 'like', "%{$search}%")
            ->where('user_id', auth()->id())
            ->limit(10)
            ->pluck('name', 'id')
            ->toArray();

        $this->dispatch('search-response', $categories);
    }

    /**
     * Handles the 'selected' event to set the selected parent category ID.
     *
     * @param array{id: int, name: string} $data The selected category data
     * @return void
     */
    #[On('selected')]
    public function selectedCategory(array $data): void
    {
        $this->category_id = $data['id'];
    }

    /**
     * Reset the pagination when any public property is being updated.
     *
     * This ensures that the user is returned to the first page
     * whenever filters or search terms change.
     *
     * @return void
     */
    public function updating(): void
    {
        $this->resetPage();
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

    /**
     * Convert formatted price string (e.g., "R$ 1.234,56") to float-compatible numeric string ("1234.56")
     *
     * @param string $price
     * @return string
     */
    private function sanitizePrice(string $price): string
    {
        $clean = preg_replace('/[^\d,]/', '', $price);
        return str_replace(',', '.', $clean);
    }
}
