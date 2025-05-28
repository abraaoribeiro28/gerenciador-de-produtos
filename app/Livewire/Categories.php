<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;

    public ?string $search = null;
    public ?string $sortBy = null;
    public ?string $sortDir = null;

    public ?bool $isModalOpen = false;
    public ?array $options = [];
    public ?string $searchTerm = null;
    public ?string $name = null;
    public ?string $parent_id = null;
    public ?string $slug = null;
    public ?bool $status = true;
    public ?int $categoryId = null;
    public ?string $nameCategorySelected = null;

    protected $queryString = ['search'];

    protected function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'unique:categories,slug,' . $this->categoryId,
            'status' => 'boolean'
        ];
    }

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

    public function render(): View
    {
        $categories = Category::queryWithFilters($this->sortBy, $this->sortDir, $this->search)->paginate();

        return view('livewire.categories', [
            'categories' => $categories,
        ]);
    }

    protected function resetForm(): void
    {
        $this->reset(['categoryId', 'name', 'parent_id', 'slug', 'status', 'nameCategorySelected']);
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->categoryId) {
            $category = Category::findOrFail($this->categoryId);
            $category->update($validated);
        } else {
            Category::create([
                ...$validated,
                'user_id' => auth()->id(),
            ]);
        }

        $this->resetForm();
        $this->isModalOpen = false;
    }

    public function edit(Category $category): void
    {
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->parent_id = $category->parent_id;
        $this->slug = $category->slug;
        $this->status = $category->status;

        $this->nameCategorySelected = $category->parent?->name;

        $this->options = Category::where('id', $category->parent_id)
            ->pluck('name', 'id')
            ->toArray();

        $this->isModalOpen = true;
    }

    public function updatedName(): void
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function updatedSearchTerm(): void
    {
        if (Str::length($this->searchTerm) > 2){
            $this->options = Category::where('name', 'like', '%' . $this->searchTerm . '%')
                ->limit(10)
                ->pluck('name', 'id')
                ->toArray();
        }else{
            $this->options = [];
        }
    }

    public function updating(): void
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

    public function openModal(): void
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }
}
