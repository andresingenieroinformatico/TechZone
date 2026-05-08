<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white mb-6">Tu Carrito de Compras</h1>

            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-16 text-center shadow-xl border border-gray-100 dark:border-gray-700">
                    <div class="w-24 h-24 bg-blue-50 dark:bg-blue-900/20 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-600">
                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">¡Tu carrito está vacío!</h2>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Parece que aún no has añadido nada. Explora nuestros productos y encuentra las mejores ofertas tecnológicas.</p>
                    <a href="{{ route('products.index') }}" class="btn-primary inline-flex items-center gap-3 py-4">
                        Continuar comprando
                    </a>
                </div>
            @else
                <div class="flex flex-col lg:flex-row gap-12">
                    <!-- Cart Items -->
                    <div class="flex-1 space-y-6">
                        @foreach($cartItems as $item)
                            <div class="premium-card flex flex-col sm:flex-row gap-6 p-5 sm:p-6">
                                <div class="w-full sm:w-32 aspect-square rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-900 shadow-inner">
                                    <img src="{{ $item->product->primaryImage ? $item->product->primaryImage->path : 'https://placehold.co/200x200' }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain p-2">
                                </div>
                                <div class="flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between mb-1">
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                                <p class="text-sm text-gray-500">{{ $item->product->category->name }}</p>
                                            </div>
                                            <div class="text-left sm:text-right">
                                                <p class="text-xl font-black text-gray-900 dark:text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                                                <p class="text-xs font-semibold text-gray-500">${{ number_format($item->product->price, 2) }} c/u</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                                        <form action="{{ route('cart.update', $item) }}" method="POST" class="flex flex-wrap items-end gap-3">
                                            @csrf
                                            @method('PATCH')
                                            <div>
                                                <label for="quantity-{{ $item->id }}" class="mb-1 block text-xs font-bold uppercase text-gray-500">Cantidad</label>
                                                <input id="quantity-{{ $item->id }}" type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="h-11 w-24 rounded-lg border-gray-300 text-center text-sm font-bold dark:bg-gray-700 dark:border-gray-600">
                                            </div>
                                            <button type="submit" class="h-11 rounded-lg border border-[#3483fa] px-4 text-sm font-bold text-[#3483fa] transition-colors hover:bg-blue-50">
                                                Actualizar
                                            </button>
                                            <span class="pb-3 text-xs font-medium text-gray-500">Stock disponible: {{ $item->product->stock }}</span>
                                        </form>
                                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm flex items-center gap-1 transition-colors">
                                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary -->
                    <div class="lg:w-96">
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700 sticky top-8">
                            <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Resumen</h2>
                            <div class="space-y-4 mb-8 border-b border-gray-100 dark:border-gray-700 pb-8">
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span>IVA (15%)</span>
                                    <span>${{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span>Envío</span>
                                    <span class="text-green-600 font-bold uppercase text-xs">Gratis</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-end mb-10">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                                <span class="text-3xl font-black text-blue-600">${{ number_format($total, 2) }}</span>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="btn-primary w-full py-4 text-center text-lg block">
                                Proceder al pago
                            </a>
                            <p class="text-xs text-center text-gray-500 mt-6 flex items-center justify-center gap-2">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                                Pago 100% Seguro y Encriptado
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
