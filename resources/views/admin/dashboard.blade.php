<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-2xl text-gray-900 dark:text-white leading-tight">
            Panel de Administración - TechZone
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- KPIs -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                <div class="premium-card p-8">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Ventas Totales</p>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white">${{ number_format($stats['total_sales'], 2) }}</h3>
                    <div class="mt-4 flex items-center text-green-600 text-xs font-bold gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        +12.5% vs mes anterior
                    </div>
                </div>

                <div class="premium-card p-8">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Pedidos</p>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['orders_count'] }}</h3>
                    <div class="mt-4 flex items-center text-blue-600 text-xs font-bold gap-1">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        100% procesados
                    </div>
                </div>

                <div class="premium-card p-8">
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Usuarios</p>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['users_count'] }}</h3>
                    <p class="mt-4 text-gray-500 text-xs">Registrados en la plataforma</p>
                </div>

                <div class="premium-card p-8 border-l-4 border-red-500">
                    <p class="text-xs font-black text-red-500 uppercase tracking-widest mb-1">Stock Bajo</p>
                    <h3 class="text-3xl font-black text-gray-900 dark:text-white">{{ $stats['low_stock'] }}</h3>
                    <p class="mt-4 text-red-500 text-xs font-bold">Requiere reposición inmediata</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Sales Chart -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-8">Ingresos Mensuales</h3>
                    <div class="h-80">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl border border-gray-100 dark:border-gray-700">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-8">Productos Críticos</h3>
                    <div class="space-y-6">
                        @foreach($topProducts as $product)
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl overflow-hidden bg-gray-50 dark:bg-gray-900">
                                    <img src="{{ $product->primaryImage ? $product->primaryImage->path : 'https://placehold.co/100x100' }}" alt="" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-bold text-gray-900 dark:text-white line-clamp-1">{{ $product->name }}</p>
                                    <p class="text-xs text-gray-500">Stock: {{ $product->stock }} unidades</p>
                                </div>
                                <div class="w-24 bg-gray-100 dark:bg-gray-700 rounded-full h-1.5">
                                    <div class="bg-red-500 h-1.5 rounded-full" style="width: {{ max(10, (int)$product->stock) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="w-full mt-8 py-3 rounded-xl border-2 border-gray-100 dark:border-gray-700 text-sm font-bold text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        Ver Inventario Completo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="chart-data" 
         data-labels='@json($salesData->pluck("month"))'
         data-values='@json($salesData->pluck("aggregate"))'
         class="hidden"></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartDataEl = document.getElementById('chart-data');
            const labels = JSON.parse(chartDataEl.dataset.labels);
            const data = JSON.parse(chartDataEl.dataset.values);
            const ctx = document.getElementById('salesChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Ventas ($)',
                        data: data,
                        borderColor: '#2563eb',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        borderWidth: 4,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: '#2563eb',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: { font: { weight: 'bold' } }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
