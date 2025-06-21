<div class="bg-white border-b border-gray-200" x-data="{ show: false }">
    <div class="flex flex-wrap-reverse p-4">
        <div class="relative lg:w-4/12 sm:w-6/12 w-full lg:mt-0 mt-2">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input wire:model.live="search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Digite para filtrar" />
        </div>
        <div class="lg:w-8/12 sm:w-6/12 w-full flex justify-end items-center">
            <button wire:click="openModal()" type="button" class="mr-2 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-[16px] h-[16px] text-gray-800 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                </svg>
                adicionar produto
            </button>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Nome
                        <button wire:click="sort('name')" class="ml-1">
                            <x-text-column-sort-icon lable="name" :sortBy="$this->sortBy" :sortDir="$this->sortDir"/>
                        </button>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Categoria
                        <button wire:click="sort('category')" class="ml-1">
                            <x-text-column-sort-icon lable="category" :sortBy="$this->sortBy" :sortDir="$this->sortDir"/>
                        </button>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Preço
                        <button wire:click="sort('price')" class="ml-1">
                            <x-text-column-sort-icon lable="stock" :sortBy="$this->sortBy" :sortDir="$this->sortDir" type="number"/>
                        </button>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Quantidade em estoque
                        <button wire:click="sort('stock')" class="ml-1">
                            <x-text-column-sort-icon lable="stock" :sortBy="$this->sortBy" :sortDir="$this->sortDir" type="number"/>
                        </button>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <div class="flex items-center">
                        Status
                        <button wire:click="sort('status')" class="ml-1">
                            <x-text-column-sort-icon lable="status" :sortBy="$this->sortBy" :sortDir="$this->sortDir"/>
                        </button>
                    </div>
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Ações</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr class="bg-white border-b border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $product->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $product->category->name ?? '' }}
                    </td>
                    <td class="px-6 py-4">
                        R$ {{ number_format((float) $product->price, 2, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $product->stock ?? 'Sem estoque' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($product->status)
                            <span class="bg-green-300 text-green-900 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Ativado</span>
                        @else
                            <span class="bg-red-300 text-red-900 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Desativado</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 flex justify-end">
                        <button wire:click="edit({{$product->id}})" type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Editar
                        </button>
                        <button wire:click="confirmDelete({{$product->id}})" type="button" class="ml-1 px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 hover:bg-red-800 rounded-lg  focus:ring-4 focus:ring-red-300 focus:outline-none">
                            Excluir
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $products->links('vendor.pagination.tailwind') }}
        </div>
    </div>

    <x-modal maxWidth="6xl" wire:model.live="showModalForm" class="overflow-visible">
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                Cadastrar categoria
            </div>

            <div class="mt-4 text-sm text-gray-600 flex flex-wrap">
                <div class="mb-4 w-full md:w-6/12 md:pr-1">
                    <x-label class="mb-1">Nome</x-label>
                    <x-input placeholder="Nome do produto" class="w-full sm:text-sm py-2" wire:model.live="name" name="name"/>
                    <div class="text-red-500">
                        @if ($errors->has('slug'))
                            {{ $errors->first('slug') }}
                        @elseif ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </div>
                </div>

                <div class="mb-4 w-full md:w-6/12 md:pl-1">
                    <livewire:components.select-search label="Categoria" />
                    @error('category_id')
                        {{ $message }}
                    @enderror
                </div>

                <div class="mb-4 w-full md:w-6/12 md:pr-1">
                    <x-label class="mb-1">Preço</x-label>
                    <x-input placeholder="R$0,00" class="money w-full sm:text-sm py-2" wire:model.live="price" name="price"/>
                    <div class="text-red-500">
                        @error('price')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-4 w-full md:w-6/12 md:pl-1">
                    <x-label class="mb-1">Estoque</x-label>
                    <x-input placeholder="Quantidade em estoque" class="w-full sm:text-sm py-2" wire:model.live="stock" name="stock"/>
                    <div class="text-red-500">
                        @error('stock')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-4 w-full">
                    <x-label class="mb-1">Descrição</x-label>
                    <textarea wire:model.live="description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full sm:text-sm py-2" rows="6"></textarea>
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>

                <x-switch-input model="status" label="Marque para ativar" />
            </div>
        </div>

        <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-end rounded-b-lg">
            <x-button wire:click="save()">
                Salvar
            </x-button>
        </div>
    </x-modal>

    <x-modal maxWidth="2xl" wire:model.live="showModalDelete" class="overflow-visible">
        <div class="px-6 py-4">
            <div class="text-lg font-medium text-gray-900">
                Confirmar Exclusão
            </div>

            <div class="mt-4 text-sm text-gray-600 space-y-4">
                <p>Tem certeza de que deseja excluir este produto?</p>

                <div class="bg-red-100 text-red-700 p-3 rounded-md border border-red-300 text-sm">
                    Atenção: Esta operação é irreversível.
                </div>
            </div>
        </div>

        <div class="flex flex-row justify-end gap-3 px-6 py-4 bg-gray-100 text-end rounded-b-lg">
            <x-button wire:click="$set('showModalDelete', false)" class="bg-gray-600 hover:bg-gray-700">
                Cancelar
            </x-button>

            <x-button wire:click="delete" class="bg-red-700 hover:bg-red-800">
                Confirmar Exclusão
            </x-button>
        </div>
    </x-modal>
</div>

<script>
    document.querySelector('.money').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = (parseInt(value, 10) / 100).toFixed(2) + '';
        value = value.replace('.', ',');
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        e.target.value = 'R$ ' + value;
    });
</script>
