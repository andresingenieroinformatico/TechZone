<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-600">Inicio</a></li>
                    <li>
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                    </li>
                    <li><a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-blue-600">{{ $product->category->name }}</a></li>
                </ol>
            </nav>

            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden mb-12">
                <div class="flex flex-col lg:flex-row">
                    <!-- Image Gallery -->
                    <div class="lg:w-1/2 p-8 bg-gray-50 dark:bg-gray-900/50">
                        <div x-data="{ activeImage: '{{ $product->primaryImage ? $product->primaryImage->path : 'https://placehold.co/800x600' }}' }">
                            <div class="aspect-square rounded-2xl overflow-hidden mb-4 bg-white dark:bg-gray-800 shadow-inner">
                                <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-contain p-4">
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                @foreach($product->images as $image)
                                    <button @click="activeImage = '{{ $image->path }}'" class="aspect-square rounded-xl overflow-hidden border-2 transition-all" :class="activeImage == '{{ $image->path }}' ? 'border-blue-600' : 'border-transparent hover:border-gray-300'">
                                        <img src="{{ $image->path }}" alt="Gallery" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="lg:w-1/2 p-12">
                        <div class="mb-4">
                            <span class="text-blue-600 font-bold uppercase tracking-widest text-xs">{{ $product->category->name }}</span>
                            <h1 class="text-4xl font-black text-gray-900 dark:text-white mt-2">{{ $product->name }}</h1>
                        </div>

                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex items-center text-amber-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ $i <= $product->average_rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                @endfor
                            </div>
                            <span class="text-sm font-medium text-gray-500">({{ $product->reviews->count() }} valoraciones)</span>
                        </div>

                        <div class="text-gray-600 dark:text-gray-400 mb-8 leading-relaxed">
                            {{ $product->description }}
                        </div>

                        <div class="mb-10">
                            <span class="text-5xl font-black text-gray-900 dark:text-white">{{ $product->formatted_price }}</span>
                            <p class="text-sm text-gray-500 mt-1">IVA incluido (15%)</p>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center gap-4 mb-12">
                            <form action="{{ route('cart.store') }}" method="POST" class="w-full flex gap-4">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="w-32">
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full rounded-2xl border-gray-300 dark:bg-gray-700 dark:border-gray-600 p-3">
                                </div>
                                <button type="submit" class="flex-1 btn-primary py-4 flex items-center justify-center gap-3">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                    Añadir al Carrito
                                </button>
                            </form>
                        </div>

                        <div class="border-t border-gray-100 dark:border-gray-700 pt-8 space-y-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 uppercase tracking-wider font-bold">Vendido por</p>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $product->seller->name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center text-green-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 uppercase tracking-wider font-bold">Disponibilidad</p>
                                    <p class="font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock > 0 ? 'En Stock (' . $product->stock . ' unidades)' : 'Agotado' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="mb-12">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Opiniones de clientes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($product->reviews as $review)
                        <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $review->user->name }}</span>
                                </div>
                                <div class="flex text-amber-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-gray-600 dark:text-gray-400 italic">"{{ $review->comment }}"</p>
                        </div>
                    @empty
                        <p class="text-gray-500">Aún no hay valoraciones para este producto.</p>
                    @endforelse
                </div>
            </div>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div>
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Productos relacionados</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <div class="premium-card group">
                                <a href="{{ route('products.show', $related->slug) }}">
                                    <div class="aspect-square overflow-hidden rounded-t-2xl">
                                        <img src="{{ $related->primaryImage ? $related->primaryImage->path : 'https://placehold.co/400x400' }}" alt="{{ $related->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors line-clamp-1">{{ $related->name }}</h3>
                                        <p class="text-xl font-black text-blue-600 mt-2">{{ $related->formatted_price }}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
