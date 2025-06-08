<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Categories extends Component
{
    use WithPagination;

    // Search and sorting
    public ?string $search = null;
    public ?string $sortBy = null;
    public ?string $sortDir = null;

    // MModal visibility control
    public bool $showModalForm = false;
    public bool $showModalDelete = false;

    // Form data
    public bool $status = true;
    public ?string $name = null;
    public ?string $slug = null;
    public ?string $parent_id = null;

    // Identifiers for edit and delete actions
    public ?int $categoryId = null;
    public ?Category $categoryToDelete = null;

    protected array $queryString = ['search'];

    /**
     * Render the Livewire component view with filtered categories.
     *
     * @return View
     */
    public function render(): View
    {
        $categories = Category::queryWithFilters(
            $this->sortBy,
            $this->sortDir,
            $this->search
        )->paginate();

        return view('livewire.categories', compact('categories'));
    }

    /**
     * Get the validation rules for the category form.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'slug' => [Rule::unique('categories', 'slug')->ignore($this->categoryId)],
            'status' => ['boolean'],
        ];
    }

    /**
     * Custom validation messages for the category form.
     *
     * @return array<string>
     */
    protected function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O campo nome deve ter pelo menos 3 caracteres.',
            'name.max' => 'O campo nome não deve ter mais de 255 caracteres.',
            'parent_id.exists' => 'A categoria parente selecionada não existe na base de dados.',
            'slug.unique' => 'O campo nome já existe.'
        ];
    }

    /**
     * Open the category form modal and reset its state.
     *
     * @return void
     */
    public function openModal(): void
    {
        $this->resetForm();
        $this->showModalForm = true;
    }

    /**
     * Populates the form with data from the selected category for editing.
     * Also triggers a modal and dispatches the 'set-property' event to update reactive components.
     *
     * @param  Category  $category
     * @return void
     */
    public function edit(Category $category): void
    {
        $this->resetForm();
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;
        $this->slug = $category->slug;
        $this->status = $category->status;

        $this->selectedParentName = $category->parent?->name;

        $this->parentCategoryOptions = Category::where('id', $category->parent_id)
            ->pluck('name', 'id')
            ->toArray();

        $this->showModalForm = true;

        $this->dispatch('set-property', [
            'id' => $category->id,
            'name' => $category->parent?->name,
        ]);
    }

    /**
     * Validate and save the category.
     * Creates a new record or updates the existing one based on categoryId.
     *
     * @return void
     */
    public function save(): void
    {
        $validated = $this->validate();

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            [...$validated, 'user_id' => auth()->id(),]
        );

        $this->resetForm();
        $this->showModalForm = false;
    }

    /**
     * Resets all category form-related fields to their default values
     * and dispatches the 'reset-form' event to notify dependent components.
     *
     * @return void
     */
    protected function resetForm(): void
    {
        $this->reset([
            'name',
            'slug',
            'status',
            'parent_id',
            'categoryId',
        ]);

        $this->dispatch('reset-form');
    }

    /**
     * Prepare and open the delete confirmation modal for the selected category.
     *
     * @param Category $category
     * @return void
     */
    public function confirmDelete(Category $category): void
    {
        $this->categoryToDelete = $category;
        $this->showModalDelete = true;
    }

    /**
     * Delete the selected category and close the confirmation modal.
     *
     * @return void
     */
    public function delete(): void
    {
        $this->categoryToDelete->delete();
        $this->categoryToDelete = null;
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
     * Update the parent category options dynamically as the search term changes.
     * Triggers when the user types in the parent category search field.
     *
     * @return void
     */
    public function updatedParentCategorySearch(): void
    {
        if (Str::length($this->parentCategorySearch) > 2) {
            $this->parentCategoryOptions = Category::where('name', 'like', '%' . $this->parentCategorySearch . '%')
                ->limit(10)
                ->pluck('name', 'id')
                ->toArray();
        } else {
            $this->parentCategoryOptions = [];
        }
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
    public function selectedParenteCategory(array $data): void
    {
        $this->parent_id = $data['id'];
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
}
