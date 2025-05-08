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

    // --- Busca e ordenação da listagem --- ///
    public ?string $search = null;
    public ?string $sortBy = null;
    public ?string $sortDir = null;

    // --- Modal e formulário --- //
    public ?bool $isModalOpen = false;
    public ?array $options = [];
    public ?string $searchTerm = null;
    public ?string $name = null;
    public ?string $parent_id = null;
    public ?string $slug = null;
    public ?bool $status = true;

    protected $queryString = ['search'];

    protected function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'slug' => 'unique:categories,slug',
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
        $this->reset(['name', 'parent_id', 'slug', 'status']);
    }

    public function save()
    {
        $validated = $this->validate();

        Category::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        $this->resetForm();
        $this->isModalOpen = false;
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
