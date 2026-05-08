<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-black text-gray-900 dark:text-white mb-12">Finalizar Compra</h1>

            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="flex flex-col lg:flex-row gap-12">
                    <!-- Checkout Details -->
                    <div class="flex-1 space-y-12">
                        <section class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-black">1</span>
                                Dirección de Envío
                            </h2>
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Dirección Completa</label>
                                <textarea name="shipping_address" rows="3" required class="w-full rounded-2xl border-gray-300 dark:bg-gray-700 dark:border-gray-600 focus:ring-blue-600 focus:border-blue-600" placeholder="Ej: Av. Principal 123, Edif. Tech, Apto 4B. Ciudad, Código Postal."></textarea>
                            </div>
                        </section>

                        <section class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-black">2</span>
                                Método de Pago (Simulado)
                            </h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <label class="relative flex items-center p-6 border-2 rounded-2xl cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all" x-data="{ selected: true }" :class="selected ? 'border-blue-600 bg-blue-50 dark:bg-blue-900/10' : 'border-gray-200 dark:border-gray-700'">
                                    <input type="radio" name="payment_method" value="stripe" checked class="hidden" @change="selected = true">
                                    <div class="flex flex-col">
                                        <span class="font-black text-gray-900 dark:text-white uppercase tracking-wider text-xs mb-2">Stripe</span>
                                        <span class="text-sm text-gray-500">Tarjetas de Crédito / Débito</span>
                                    </div>
                                    <div class="ml-auto">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Stripe_Logo%2C_revised_2016.svg" alt="Stripe" class="h-6">
                                    </div>
                                </label>

                                <label class="relative flex items-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-2xl cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all">
                                    <input type="radio" name="payment_method" value="mercadopago" class="hidden">
                                    <div class="flex flex-col">
                                        <span class="font-black text-gray-900 dark:text-white uppercase tracking-wider text-xs mb-2">Mercado Pago</span>
                                        <span class="text-sm text-gray-500">Transferencias / Saldo</span>
                                    </div>
                                    <div class="ml-auto">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/Mercado_Libre_logo.svg" alt="Mercado Pago" class="h-8">
                                    </div>
                                </label>
                            </div>
                        </section>
                    </div>

                    <!-- Summary -->
                    <div class="lg:w-96">
                        <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700 sticky top-8">
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
                            </div>
                            <div class="flex justify-between items-end mb-10">
                                <span class="text-lg font-bold text-gray-900 dark:text-white">Total a pagar</span>
                                <span class="text-4xl font-black text-blue-600">${{ number_format($total, 2) }}</span>
                            </div>
                            <button type="submit" class="btn-primary w-full py-5 text-center text-xl block shadow-xl shadow-blue-500/30">
                                Confirmar y Pagar
                            </button>
                            <p class="text-[10px] text-center text-gray-400 mt-6 leading-tight">
                                Al confirmar tu compra, aceptas nuestros términos y condiciones. Esta es una transacción simulada para fines académicos.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
