<nav x-data="{ open: false }" class="bg-[#fff159] border-none sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Row -->
        <div class="flex items-center justify-between h-16 gap-8">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-[#3483fa] rounded-lg flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <span class="text-2xl font-black text-[#333] tracking-tighter">Tech<span class="text-[#3483fa]">Zone</span></span>
                </a>
            </div>

            <!-- Prominent Search Bar -->
            <div class="hidden md:flex flex-1 max-w-2xl">
                <form action="{{ route('products.index') }}" method="GET" class="w-full relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Busca productos, marcas y más..." class="w-full bg-white border-none rounded shadow-sm py-2 px-4 focus:ring-0 transition-all outline-none text-sm placeholder-gray-400">
                    <button type="submit" class="absolute right-0 top-0 h-full px-4 text-gray-400 border-l border-gray-100 hover:text-[#3483fa] transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                </form>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <a href="{{ route('cart.index') }}" class="relative p-2 text-[#333] hover:opacity-70 transition-opacity">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    @auth
                        @php $cartCount = Auth::user()->cartItems()->count(); @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-0 right-0 bg-[#3483fa] text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    @endauth
                </a>

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border-none text-sm font-medium rounded-md text-[#333] hover:opacity-70 transition-opacity">
                                <div>{{ Auth::user()->name }}</div>
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
                    <div class="flex items-center gap-4 text-sm font-medium">
                        <a href="{{ route('register') }}" class="text-[#333] hover:opacity-70">Crea tu cuenta</a>
                        <a href="{{ route('login') }}" class="text-[#333] hover:opacity-70">Ingresa</a>
                    </div>
                @endauth

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#333] hover:opacity-70 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Secondary Row -->
        <div class="hidden sm:flex items-center h-10 text-xs font-medium text-[#333] gap-6 overflow-x-auto whitespace-nowrap">
            <a href="{{ route('products.index') }}" class="hover:border-b-2 border-[#3483fa] pb-1">Categorías</a>
            <a href="#" class="hover:border-b-2 border-[#3483fa] pb-1">Ofertas</a>
            <a href="#" class="hover:border-b-2 border-[#3483fa] pb-1">Historial</a>
            <a href="#" class="hover:border-b-2 border-[#3483fa] pb-1">Vender</a>
            <a href="#" class="hover:border-b-2 border-[#3483fa] pb-1">Ayuda</a>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">{{ __('Productos') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="#">{{ __('Ofertas') }}</x-responsive-nav-link>
            <x-responsive-nav-link href="#">{{ __('Vender') }}</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
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
                <div class="mt-3 space-y-1 px-4 pb-4">
                    <x-responsive-nav-link :href="route('login')">{{ __('Ingresa') }}</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">{{ __('Crea tu cuenta') }}</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
