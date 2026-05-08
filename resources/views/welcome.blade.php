<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechZone | Tu Marketplace Tecnológico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 overflow-x-hidden">
    <!-- Navbar -->
    <nav class="glass sticky top-0 z-50 py-4">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <span class="text-2xl font-black text-gray-900 dark:text-white tracking-tighter">Tech<span class="text-blue-600">Zone</span></span>
            </a>

            <div class="hidden md:flex flex-1 max-w-xl mx-12">
                <form action="{{ route('products.index') }}" method="GET" class="w-full relative group">
                    <input type="text" name="search" placeholder="Busca productos, marcas y más..." class="w-full bg-gray-100 dark:bg-gray-800 border-none rounded-2xl py-3 pl-12 pr-4 focus:ring-2 focus:ring-blue-600 transition-all outline-none">
                    <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5 group-focus-within:text-blue-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </form>
            </div>

            <div class="flex items-center gap-6">
                @auth
                    <a href="{{ route('cart.index') }}" class="relative text-gray-600 dark:text-gray-400 hover:text-blue-600 transition-colors">
                        <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white dark:border-gray-900">0</span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn-primary py-2 px-4 text-sm">Mi Cuenta</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 dark:text-gray-400 hover:text-blue-600">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="btn-primary py-2 px-6 text-sm">Registrarse</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main>
        <section class="relative pt-20 pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <span class="inline-block py-1 px-3 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 text-xs font-black uppercase tracking-widest mb-6">Nueva Generación Tech</span>
                        <h1 class="text-6xl lg:text-7xl font-black text-gray-900 dark:text-white leading-[1.1] mb-8 tracking-tighter">
                            La mejor tecnología al <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">alcance</span> de un click.
                        </h1>
                        <p class="text-xl text-gray-600 dark:text-gray-400 mb-10 leading-relaxed max-w-lg">
                            Descubre miles de productos originales, envíos rápidos y garantía asegurada en TechZone Marketplace.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('products.index') }}" class="btn-primary py-4 px-8 text-lg text-center shadow-2xl shadow-blue-500/40">Explorar Catálogo</a>
                            <a href="#" class="py-4 px-8 text-lg font-bold text-gray-900 dark:text-white rounded-xl border-2 border-gray-200 dark:border-gray-700 text-center hover:bg-white dark:hover:bg-gray-800 transition-all">Ver Ofertas</a>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>
                        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-400/20 rounded-full blur-3xl"></div>
                        <img src="https://placehold.co/800x800/2563eb/white?text=TechZone+Experience" alt="Hero Image" class="relative rounded-[3rem] shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-700">
                    </div>
                </div>
            </div>
        </section>

        <!-- Categories Section -->
        <section class="py-24 bg-white dark:bg-gray-800/50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8">
                <div class="flex justify-between items-end mb-12">
                    <div>
                        <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter">Explora por Categorías</h2>
                        <p class="text-gray-500 mt-2">Encuentra exactamente lo que necesitas.</p>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-blue-600 font-bold hover:underline">Ver todas &rarr;</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    @php
                        $cat_icons = [
                            'laptops' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                            'smartphones' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z',
                            'perifericos' => 'M12 11V3m0 8l-2-2m2 2l2-2m-2 11v-3m0 3l-2-2m2 2l2-2M5 8v4a3 3 0 003 3h8a3 3 0 003-3V8a3 3 0 00-3-3H8a3 3 0 00-3 3z',
                            'componentes' => 'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z',
                        ];
                    @endphp
                    @foreach(['Laptops', 'Smartphones', 'Accesorios', 'Audio', 'Gaming', 'Componentes'] as $cat)
                        <div class="premium-card p-8 text-center group cursor-pointer">
                            <div class="w-16 h-16 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center mx-auto mb-4 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            </div>
                            <h3 class="font-bold text-gray-900 dark:text-white">{{ $cat }}</h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-20 mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-8">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <span class="text-3xl font-black tracking-tighter">Tech<span class="text-blue-500">Zone</span></span>
                    </div>
                    <p class="text-gray-400 max-w-md leading-relaxed mb-8">
                        El marketplace líder en tecnología para estudiantes y profesionales. Innovación, calidad y servicio en un solo lugar.
                    </p>
                    <div class="flex gap-4">
                        @foreach(['fb', 'tw', 'ig', 'in'] as $social)
                            <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-blue-600 transition-colors">
                                <span class="sr-only">{{ $social }}</span>
                                <div class="w-5 h-5 bg-white/20 rounded-full"></div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-8">Plataforma</h4>
                    <ul class="space-y-4 text-gray-400">
                        <li><a href="#" class="hover:text-white">Sobre nosotros</a></li>
                        <li><a href="#" class="hover:text-white">Vender en TechZone</a></li>
                        <li><a href="#" class="hover:text-white">Centro de ayuda</a></li>
                        <li><a href="#" class="hover:text-white">Privacidad</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-bold mb-8">Newsletter</h4>
                    <p class="text-gray-400 mb-6">Suscríbete para recibir ofertas exclusivas.</p>
                    <form class="flex flex-col gap-3">
                        <input type="email" placeholder="tu@email.com" class="bg-gray-800 border-none rounded-xl py-3 px-4 outline-none focus:ring-2 focus:ring-blue-600">
                        <button class="btn-primary py-3">Suscribirse</button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-20 pt-10 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} TechZone Marketplace. Hecho para fines académicos con ❤️.</p>
            </div>
        </div>
    </footer>
</body>
</html>
