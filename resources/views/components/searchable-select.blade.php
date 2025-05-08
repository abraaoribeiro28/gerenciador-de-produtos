@props([
    'options' => [],
    'placeholder' => 'Selecione uma opção',
    'value' => null,
    'name' => 'selected',
    'label' => null,
])

<div x-data="{
    open: false,
    selected: @entangle($attributes->wire('model')),
    placeholder: '{{ $placeholder }}'
}" class="relative w-full">

    @if ($label)
        <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif

    <div class="relative">
        <button type="button"
                @click="open = !open"
                class="relative w-full bg-white border border-gray-300 rounded-lg shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <span>
                <span x-text="selected ? selectedName : placeholder"></span>
            </span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>

        <input type="hidden" name="{{ $name }}" :value="selected">

        <div x-show="open" @click.away="open = false" class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-lg max-h-60 overflow-auto border border-gray-200">
            <div class="p-2">
                <input
                    type="text"
                    placeholder="Digite 3 letras para buscar"
                    wire:model.live="searchTerm"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
            </div>
            <ul class="py-1">
                @forelse ($options as $key => $label)
                    <li wire:key="{{ $key }}"
                        @click="selected = {{ $key }}; open = false; selectedName = '{{ $label }}'"
                        class="cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-indigo-600 hover:text-white">
                        <span>{{ $label }}</span>
                        <span x-show="selected === '{{ $key }}'" class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                    </li>
                @empty
                    <li class="text-gray-500 px-3 py-2">
                        Nenhum resultado encontrado
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
