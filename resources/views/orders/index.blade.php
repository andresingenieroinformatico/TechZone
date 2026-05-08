<x-app-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-widest text-[#3483fa]">Historial</p>
                    <h1 class="mt-2 text-3xl font-black text-gray-900 dark:text-white">Mis pedidos</h1>
                </div>
                <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-lg border border-[#3483fa] px-4 py-2 text-sm font-bold text-[#3483fa] hover:bg-blue-50">
                    Seguir comprando
                </a>
            </div>

            @if($orders->isEmpty())
                <div class="rounded-lg border border-gray-100 bg-white p-12 text-center shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-blue-50 text-[#3483fa]">
                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14h6m-6-4h6m2 11H7a2 2 0 01-2-2V5a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-black text-gray-900 dark:text-white">Aun no tienes pedidos</h2>
                    <p class="mt-2 text-sm text-gray-500">Cuando completes una compra, la veras aqui con su estado y comprobante.</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <article class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h2 class="text-lg font-black text-gray-900 dark:text-white">Pedido #{{ $order->id }}</h2>
                                        <span class="rounded-full bg-green-50 px-3 py-1 text-xs font-bold uppercase text-green-700">
                                            {{ $order->status === 'paid' ? 'Pagado' : ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">{{ $order->created_at->format('d/m/Y H:i') }} · {{ $order->items->sum('quantity') }} unidades</p>
                                    <p class="mt-2 max-w-2xl truncate text-sm text-gray-600 dark:text-gray-300">
                                        {{ $order->items->pluck('product.name')->filter()->join(', ') }}
                                    </p>
                                </div>

                                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                                    <div class="text-left sm:text-right">
                                        <p class="text-xs font-bold uppercase text-gray-400">Total</p>
                                        <p class="text-2xl font-black text-[#3483fa]">${{ number_format($order->total, 2) }}</p>
                                    </div>
                                    <a href="{{ route('orders.show', $order) }}" class="inline-flex h-11 items-center justify-center rounded-lg bg-[#3483fa] px-4 text-sm font-bold text-white hover:bg-[#2968c8]">
                                        Ver detalle
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
