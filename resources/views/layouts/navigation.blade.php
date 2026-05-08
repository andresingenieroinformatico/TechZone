<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Row -->
        <div class="flex items-center justify-between h-16 gap-8">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <span class="text-xl font-black text-gray-900 dark:text-white tracking-tighter">Tech<span class="text-blue-600">Zone</span></span>
                </a>
            </div>

            <!-- Prominent Search Bar (Amazon/Mercado Libre style) -->
            <div class="hidden md:flex flex-1 max-w-2xl">
                <form action="{{ route('products.index') }}" method="GET" class="w-full relative group">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Busca productos, marcas y más..." class="w-full bg-gray-100 dark:bg-gray-800 border-none rounded-xl py-2.5 pl-12 pr-4 focus:ring-2 focus:ring-blue-600 transition-all outline-none text-sm">
                    <button type="submit" class="absolute left-4 top-2.5 text-gray-400 group-focus-within:text-blue-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                </form>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2 sm:gap-6">
                <!-- Sell Link -->
                <a href="#" class="hidden lg:block text-sm font-bold text-gray-600 dark:text-gray-400 hover:text-blue-600 transition-colors">Vender</a>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-600 dark:text-gray-400 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    @auth
                        @php $cartCount = Auth::user()->cartItems()->count(); @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 bg-blue-600 text-white text-[10px] font-black w-4 h-4 rounded-full flex items-center justify-center border-2 border-white dark:border-gray-900">{{ $cartCount }}</span>
                        @endif
                    @endauth
                </a>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="font-bold">{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            @if(Auth::user()->isAdmin())
                                <x-dropdown-link :href="route('admin.dashboard')">{{ __('Admin Panel') }}</x-dropdown-link>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="text-sm font-bold text-gray-600 dark:text-gray-400 hover:text-blue-600">Entrar</a>
                        <a href="{{ route('register') }}" class="btn-primary py-2 px-5 text-xs">Unirse</a>
                    </div>
                @endauth

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Secondary Row (Categories) -->
        <div class="hidden sm:flex items-center h-10 border-t border-gray-50 dark:border-gray-800 text-xs font-medium text-gray-500 dark:text-gray-400 gap-6">
            <a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">Categorías</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Ofertas</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Historial</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Supermercado</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Moda</a>
            <a href="#" class="hover:text-blue-600 transition-colors">Ayuda</a>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-gray-900 border-t border-gray-100 dark:border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <div class="px-4 mb-4">
                <form action="{{ route('products.index') }}" method="GET" class="relative">
                    <input type="text" name="search" placeholder="Busca productos..." class="w-full bg-gray-100 dark:bg-gray-800 border-none rounded-lg py-2 pl-10 text-sm">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </form>
            </div>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">{{ __('Productos') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="#">{{ __('Ofertas') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="#">{{ __('Vender') }}</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            @auth
                <div class="px-4">
                    <div class="font-bold text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">{{ __('Profile') }}</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">{{ __('Log Out') }}</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4 pb-4 flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="btn-primary text-center py-2 text-sm">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="w-full py-2 text-center text-sm font-bold border-2 border-gray-200 dark:border-gray-700 rounded-xl text-gray-600 dark:text-gray-400">Crear Cuenta</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
