<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Sidebar Filters -->
                <aside class="w-full md:w-64 space-y-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Categorías</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('products.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 {{ !request('category') ? 'font-bold text-blue-600' : '' }}">Todas</a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 {{ request('category') == $category->slug ? 'font-bold text-blue-600' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Precio</h3>
                        <form action="{{ route('products.index') }}" method="GET" class="space-y-4">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="flex items-center gap-2">
                                <input type="number" name="min_price" placeholder="Min" value="{{ request('min_price') }}" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-sm">
                                <span class="text-gray-400">-</span>
                                <input type="number" name="max_price" placeholder="Max" value="{{ request('max_price') }}" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-sm">
                            </div>
                            <button type="submit" class="w-full bg-[#3483fa] hover:bg-[#2968c8] text-white font-semibold rounded-lg transition-colors duration-200 text-sm py-2">Filtrar</button>
                        </form>
                    </div>
                </aside>

                <!-- Product Grid -->
                <div class="flex-1">
                    <div class="flex justify-between items-center mb-8">
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                            {{ request('category') ? ucfirst(str_replace('-', ' ', request('category'))) : 'Todos los Productos' }}
                        </h1>
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">{{ $products->total() }} productos encontrados</span>
                            <select onchange="window.location.href=this.value" class="rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 text-sm">
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" {{ request('sort') == 'latest' ? 'selected' : '' }}>Lo más nuevo</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                                <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                            </select>
                        </div>
                    </div>

                    @if($products->isEmpty())
                        <div class="bg-white dark:bg-gray-800 rounded-2xl p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No se encontraron productos</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Intenta ajustar tus filtros o buscar algo diferente.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($products as $product)
                                <div class="premium-card group">
                                    <a href="{{ route('products.show', $product->slug) }}">
                                        <div class="relative aspect-square overflow-hidden rounded-t-2xl">
                                            <img src="{{ $product->primaryImage ? $product->primaryImage->path : 'https://placehold.co/400x400' }}" alt="{{ $product->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                            @if($product->is_featured)
                                                <span class="absolute top-4 left-4 bg-amber-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">Destacado</span>
                                            @endif
                                            @if($product->stock <= 5)
                                                <span class="absolute bottom-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">¡Últimas {{ $product->stock }} unidades!</span>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="p-6">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-widest">{{ $product->category->name }}</span>
                                            @if($product->price > 500)
                                                <span class="badge-free-shipping">Envío Gratis</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('products.show', $product->slug) }}" class="block mb-2">
                                            <h2 class="text-base font-medium text-gray-800 dark:text-gray-200 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[3rem]">{{ $product->name }}</h2>
                                        </a>
                                        
                                        <div class="flex items-center gap-2 mb-4">
                                            <div class="flex text-amber-400">
                                                @for($i = 0; $i < 5; $i++)
                                                    <svg class="h-3.5 w-3.5" fill="{{ $i < floor($product->average_rating) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                                @endfor
                                            </div>
                                            <span class="text-xs text-gray-400">({{ $product->reviews->count() }})</span>
                                        </div>

                                        <div class="flex items-end justify-between">
                                            <div>
                                                @if($product->is_featured)
                                                    <span class="text-xs text-green-600 font-bold mb-1 block">OFERTA DEL DÍA</span>
                                                @endif
                                                <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $product->formatted_price }}</span>
                                            </div>
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="p-2.5 bg-[#3483fa] text-white rounded-xl hover:bg-[#2968c8] transition-all duration-300 shadow-md shadow-[#3483fa]/20">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $products->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
