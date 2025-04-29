<div class="bg-white border-b border-gray-200">
    <div class="flex flex-wrap p-4">
        <div class="relative lg:w-4/12 md:w-6/12 w-full lg:mb-0 mb-2">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input wire:model.live="search" class="block w-full p-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Digite para filtrar" />
        </div>
        <div class="lg:w-8/12 md:w-6/12 w-full flex justify-end items-center">
            <button type="button" class="mr-2 px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                <svg class="w-[16px] h-[16px] text-gray-800 text-white mr-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                </svg>
                adicionar categoria
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
                            Categoria parente
                            <button wire:click="sort('category')" class="ml-1">
                                <x-text-column-sort-icon lable="category" :sortBy="$this->sortBy" :sortDir="$this->sortDir"/>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            Quantidade de produtos
                            <button wire:click="sort('products_count')" class="ml-1">
                                <x-text-column-sort-icon lable="products_count" :sortBy="$this->sortBy" :sortDir="$this->sortDir" type="number"/>
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
                @foreach($categories as $category)
                    <tr class="bg-white border-b border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $category->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $category->parent->name ?? '' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->products_count }}
                        </td>
                        <td class="px-6 py-4">
                            @if($category->status)
                                <span class="bg-green-300 text-green-900 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Ativado</span>
                            @else
                                <span class="bg-red-300 text-red-900 text-xs font-medium me-2 px-2.5 py-0.5 rounded">Desativado</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex justify-end">
                            <button type="button" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                Editar
                            </button>
                            <button type="button" class="ml-1 px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 hover:bg-red-800 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-red-300 focus:outline-none focus:ring-blue-300">
                                Excluir
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $categories->links('vendor.pagination.tailwind') }}
        </div>
    </div>

</div>
