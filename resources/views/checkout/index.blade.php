<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white mb-6">Finalizar Compra</h1>

            @if(session('error'))
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="flex flex-col lg:flex-row gap-12">
                    <div class="flex-1 space-y-8">
                        <section class="bg-white dark:bg-gray-800 rounded-lg p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-black">1</span>
                                Direccion de envio
                            </h2>
                            <div>
                                <label for="shipping_address" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Direccion completa</label>
                                <textarea id="shipping_address" name="shipping_address" rows="3" required class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-600 focus:border-blue-600" placeholder="Ej: Av. Principal 123, Edif. Tech, Apto 4B. Ciudad, Codigo Postal.">{{ old('shipping_address') }}</textarea>
                                <x-input-error :messages="$errors->get('shipping_address')" class="mt-2" />
                            </div>
                        </section>

                        <section class="bg-white dark:bg-gray-800 rounded-lg p-8 shadow-sm border border-gray-100 dark:border-gray-700" x-data="{ paymentMethod: '{{ old('payment_method', 'stripe') }}' }">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-black">2</span>
                                Pasarela de pago
                            </h2>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="relative flex min-h-32 cursor-pointer items-center gap-4 rounded-lg border-2 p-5 transition-all hover:bg-blue-50 dark:hover:bg-blue-900/10" :class="paymentMethod === 'stripe' ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-100 dark:bg-blue-900/10' : 'border-gray-200 dark:border-gray-700'">
                                    <input type="radio" name="payment_method" value="stripe" class="sr-only" x-model="paymentMethod">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#635bff] text-white">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h2m3 0h5M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-xs font-black uppercase tracking-wider text-gray-900 dark:text-white">Stripe</span>
                                        <span class="mt-1 block text-sm text-gray-500">Tarjeta de credito o debito</span>
                                    </div>
                                    <span class="ml-auto flex h-5 w-5 items-center justify-center rounded-full border" :class="paymentMethod === 'stripe' ? 'border-blue-600 bg-blue-600' : 'border-gray-300'">
                                        <span class="h-2 w-2 rounded-full bg-white" x-show="paymentMethod === 'stripe'"></span>
                                    </span>
                                </label>

                                <label class="relative flex min-h-32 cursor-pointer items-center gap-4 rounded-lg border-2 p-5 transition-all hover:bg-blue-50 dark:hover:bg-blue-900/10" :class="paymentMethod === 'mercadopago' ? 'border-blue-600 bg-blue-50 ring-2 ring-blue-100 dark:bg-blue-900/10' : 'border-gray-200 dark:border-gray-700'">
                                    <input type="radio" name="payment_method" value="mercadopago" class="sr-only" x-model="paymentMethod">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#fff159] text-[#333]">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <span class="block text-xs font-black uppercase tracking-wider text-gray-900 dark:text-white">Mercado Pago</span>
                                        <span class="mt-1 block text-sm text-gray-500">Transferencias o saldo</span>
                                    </div>
                                    <span class="ml-auto flex h-5 w-5 items-center justify-center rounded-full border" :class="paymentMethod === 'mercadopago' ? 'border-blue-600 bg-blue-600' : 'border-gray-300'">
                                        <span class="h-2 w-2 rounded-full bg-white" x-show="paymentMethod === 'mercadopago'"></span>
                                    </span>
                                </label>
                            </div>

                            <x-input-error :messages="$errors->get('payment_method')" class="mt-3" />
                            <p class="mt-4 rounded-lg bg-gray-50 px-4 py-3 text-sm text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                Esta pasarela es simulada: registra el pago y descuenta stock para probar el flujo completo.
                            </p>
                        </section>
                    </div>

                    <div class="lg:w-96">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-8 shadow-sm border border-gray-100 dark:border-gray-700 sticky top-8">
                            <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8">Resumen del Pedido</h2>
                            <div class="space-y-4 mb-8 max-h-64 overflow-y-auto pr-2">
                                @foreach($cartItems as $item)
                                    <div class="flex justify-between items-center gap-4 text-sm">
                                        <span class="text-gray-600 dark:text-gray-400 font-medium line-clamp-1 flex-1">{{ $item->product->name }} (x{{ $item->quantity }})</span>
                                        <span class="font-bold text-gray-900 dark:text-white">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="space-y-4 mb-8 border-t border-gray-100 dark:border-gray-700 pt-8">
                                <div class="flex justify-between text-gray-500">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-500">
                                    <span>IVA (15%)</span>
                                    <span>${{ number_format($tax, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-gray-500">
                                    <span>Envio</span>
                                    <span class="text-xs font-bold uppercase text-green-600">Gratis</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-end mb-10">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">Total a pagar</span>
                                <span class="text-4xl font-black text-blue-600">${{ number_format($total, 2) }}</span>
                            </div>
                            <button type="submit" class="btn-primary w-full py-5 text-center text-xl block">
                                Confirmar y Pagar
                            </button>
                            <p class="text-[10px] text-center text-gray-400 mt-6 leading-tight">
                                Al confirmar tu compra, aceptas nuestros terminos y condiciones. Esta es una transaccion simulada para pruebas.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
