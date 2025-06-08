<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Str;

class SelectSearch extends Component
{
    public array $data = [];
    public string $search = '';
    public string $label = '';
    public string $placeholder = 'Selecione...';
    public ?string $selectedName = null;
    public ?int $selectedId = null;

    /**
     * Render the Livewire component view
     *
     * @return View
     */
    public function render()
    {
        return view('livewire.components.select-search');
    }

    /**
     * Triggered when the search input is updated.
     * Dispatches 'searching' event if more than 2 characters.
     *
     * @return void
     */
    public function updatedSearch(): void
    {
        if (Str::length($this->search) > 2) {
            $this->dispatch('searching', $this->search);
        } else {
            $this->data = [];
        }
    }

    /**
     * Triggered when the selected ID is updated.
     * Dispatches a 'selected' event with the ID and name.
     *
     * @return void
     */
    public function updatedSelectedId(): void
    {
        $this->dispatch('selected', [
            'id' => $this->selectedId,
            'name' => $this->selectedName,
        ]);
    }

    /**
     * Handles external response from a 'search-response' event
     *
     * @param array $data
     * @return void
     */
    #[On('search-response')]
    public function response(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Resets component state when 'reset-form' event is received
     *
     * @return void
     */
    #[On('reset-form')]
    public function resetForm(): void
    {
        $this->reset([
            'data',
            'search',
            'selectedName',
            'selectedId',
        ]);
    }

    /**
     * Sets selected data via 'set-property' event
     *
     * @param array{id: int, name: string} $data
     * @return void
     */
    #[On('set-property')]
    public function setProperty(array $data): void
    {
        $this->selectedId = $data['id'];
        $this->selectedName = $data['name'];
        $this->data = [$data['id'] => $data['name']];
    }
}
