<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-semibold text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <a href="{{ route('orders.index') }}" class="text-sm font-bold text-[#3483fa] hover:text-[#2968c8]">Volver a mis pedidos</a>
                    <h1 class="mt-2 text-3xl font-black text-gray-900 dark:text-white">Pedido #{{ $order->id }}</h1>
                    <p class="mt-1 text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <span class="inline-flex w-fit rounded-full bg-green-50 px-4 py-2 text-sm font-bold uppercase text-green-700">
                    {{ $order->status === 'paid' ? 'Pagado' : ucfirst($order->status) }}
                </span>
            </div>

            <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
                <div class="space-y-6">
                    <section class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h2 class="mb-5 text-xl font-black text-gray-900 dark:text-white">Productos comprados</h2>
                        <div class="space-y-4">
                            @foreach($order->items as $item)
                                <div class="flex gap-4 rounded-lg border border-gray-100 p-4 dark:border-gray-700">
                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-lg bg-gray-50 dark:bg-gray-900">
                                        <img src="{{ $item->product->primaryImage ? $item->product->primaryImage->path : 'https://placehold.co/160x160' }}" alt="{{ $item->product->name }}" class="h-full w-full object-contain p-2">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-gray-900 dark:text-white">{{ $item->product->name }}</h3>
                                        <p class="mt-1 text-sm text-gray-500">Cantidad: {{ $item->quantity }}</p>
                                        <p class="mt-1 text-sm text-gray-500">Precio unitario: ${{ number_format($item->price, 2) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-black text-gray-900 dark:text-white">${{ number_format($item->price * $item->quantity, 2) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <section class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h2 class="mb-3 text-xl font-black text-gray-900 dark:text-white">Direccion de envio</h2>
                        <p class="text-sm leading-6 text-gray-600 dark:text-gray-300">{{ $order->shipping_address }}</p>
                    </section>
                </div>

                <aside class="space-y-6">
                    <section class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <h2 class="mb-5 text-xl font-black text-gray-900 dark:text-white">Resumen</h2>
                        <div class="space-y-3 border-b border-gray-100 pb-5 text-sm dark:border-gray-700">
                            <div class="flex justify-between text-gray-500">
                                <span>Subtotal</span>
                                <span>${{ number_format($order->subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>IVA (15%)</span>
                                <span>${{ number_format($order->tax, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500">
                                <span>Envio</span>
                                <span class="font-bold text-green-600">Gratis</span>
                            </div>
                        </div>
                        <div class="mt-5 flex items-end justify-between">
                            <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                            <span class="text-3xl font-black text-[#3483fa]">${{ number_format($order->total, 2) }}</span>
                        </div>
                    </section>

                    @if($order->payment)
                        <section class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <h2 class="mb-5 text-xl font-black text-gray-900 dark:text-white">Pago</h2>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500">Proveedor</span>
                                    <span class="font-bold text-gray-900 dark:text-white">{{ $order->payment->provider === 'mercadopago' ? 'Mercado Pago' : 'Stripe' }}</span>
                                </div>
                                <div class="flex justify-between gap-4">
                                    <span class="text-gray-500">Estado</span>
                                    <span class="font-bold text-green-600">{{ $order->payment->status === 'completed' ? 'Completado' : ucfirst($order->payment->status) }}</span>
                                </div>
                                <div>
                                    <span class="block text-gray-500">Transaccion</span>
                                    <span class="mt-1 block break-all rounded-lg bg-gray-50 px-3 py-2 font-mono text-xs text-gray-700 dark:bg-gray-900 dark:text-gray-300">{{ $order->payment->transaction_id }}</span>
                                </div>
                            </div>
                        </section>
                    @endif
                </aside>
            </div>
        </div>
    </div>
</x-app-layout>
