<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Visão geral</p>
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">Dashboard</h2>
            </div>
            <span class="text-sm text-gray-500">Atualizado em {{ now()->format('d/m/Y H:i') }}</span>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div class="p-4 rounded-2xl shadow bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                    <p class="text-sm uppercase tracking-wide text-white/80">Produtos</p>
                    <div class="flex items-end justify-between mt-3">
                        <span class="text-4xl font-bold">{{ $totalProducts }}</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-white/20">Ativos {{ $activeProducts }}</span>
                    </div>
                    <p class="mt-2 text-xs text-white/80">{{ $activeRate }}% dos produtos estão ativos</p>
                </div>

                <div class="p-4 rounded-2xl shadow bg-white border border-gray-100">
                    <p class="text-sm text-gray-500">Categorias</p>
                    <div class="flex items-end justify-between mt-3">
                        <span class="text-4xl font-bold text-gray-900">{{ $totalCategories }}</span>
                        <span class="text-xs text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">Organização</span>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Categorias com mais produtos ao lado</p>
                </div>

                <div class="p-4 rounded-2xl shadow bg-white border border-gray-100">
                    <p class="text-sm text-gray-500">Estoque (unidades)</p>
                    <div class="flex items-end justify-between mt-3">
                        <span class="text-4xl font-bold text-gray-900">{{ $stockUnits }}</span>
                        <span class="text-xs text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Em armazém</span>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Valor estimado: R$ {{ number_format((float) $inventoryValue, 2, ',', '.') }}</p>
                </div>

                <div class="p-4 rounded-2xl shadow bg-white border border-gray-100">
                    <p class="text-sm text-gray-500">Imagens vinculadas</p>
                    <div class="flex items-end justify-between mt-3">
                        <span class="text-4xl font-bold text-gray-900">{{ $totalImages }}</span>
                        <span class="text-xs text-blue-700 bg-blue-50 px-3 py-1 rounded-full">Galeria</span>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Arquivos usados nos produtos</p>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl shadow">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <p class="text-sm text-gray-500">Últimos produtos</p>
                            <h3 class="text-lg font-semibold text-gray-900">Recentes</h3>
                        </div>
                        <a href="{{ route('produtos.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Ver todos</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoria</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estoque</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentProducts as $product)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? 'Sem categoria' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">R$ {{ number_format((float) $product->price, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->stock }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-6 text-center text-sm text-gray-500">Nenhum produto cadastrado ainda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-white border border-gray-100 rounded-2xl shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Saúde do catálogo</p>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $activeRate }}% ativos</h3>
                            </div>
                            <span class="text-xs text-gray-500">{{ $activeProducts }} / {{ $totalProducts }} produtos</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-2 bg-gradient-to-r from-emerald-500 to-blue-500" style="width: {{ $activeRate }}%"></div>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-100 rounded-2xl shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <p class="text-sm text-gray-500">Categorias com mais produtos</p>
                                <h3 class="text-lg font-semibold text-gray-900">Top 5</h3>
                            </div>
                            <span class="text-xs text-gray-500">{{ $totalCategories }} categorias</span>
                        </div>
                        <div class="space-y-3">
                            @forelse($topCategories as $category)
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $category->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $category->products_count }} produtos</p>
                                    </div>
                                    <span class="text-xs px-3 py-1 rounded-full bg-indigo-50 text-indigo-600">#{{ $loop->iteration }}</span>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">Nenhuma categoria cadastrada.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
