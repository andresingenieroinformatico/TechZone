@php
    $user = Auth::user();
    $isAdmin = $user?->isAdmin();
    $cartCount = $user && ! $isAdmin ? $user->cartItems()->count() : 0;
@endphp

<nav x-data="{ open: false }" class="{{ $isAdmin ? 'bg-gray-950 text-white' : 'bg-[#fff159] text-[#333]' }} sticky top-0 z-40 border-none">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between gap-4 sm:gap-8">
            <div class="flex shrink-0 items-center">
                <a href="{{ $isAdmin ? route('admin.dashboard') : route('home') }}" class="flex items-center gap-2">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#3483fa] text-white shadow-sm">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="hidden text-2xl font-black sm:block">
                        Tech<span class="text-[#3483fa]">Zone</span>
                    </span>
                </a>
            </div>

            @if($isAdmin)
                <div class="hidden flex-1 items-center gap-3 sm:flex">
                    <span class="rounded-lg bg-white/10 px-3 py-2 text-sm font-bold text-white">Panel de administracion</span>
                    <a href="{{ route('products.index') }}" class="text-sm font-semibold text-gray-300 hover:text-white">Ver catalogo publico</a>
                </div>
            @else
                <div class="max-w-2xl flex-1">
                    <form action="{{ route('products.index') }}" method="GET" class="relative w-full">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Busca productos, marcas y mas..." class="w-full rounded border-none bg-white px-4 py-2 text-sm text-gray-900 shadow-sm outline-none transition-all placeholder:text-gray-400 focus:ring-0">
                        <button type="submit" class="absolute right-0 top-0 h-full border-l border-gray-100 px-4 text-gray-400 transition-colors hover:text-[#3483fa]" aria-label="Buscar">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endif

            <div class="flex items-center gap-2 sm:gap-4">
                @guest
                    <div class="hidden items-center gap-4 text-sm font-medium sm:flex">
                        <a href="{{ route('register') }}" class="hover:opacity-70">Crea tu cuenta</a>
                        <a href="{{ route('login') }}" class="hover:opacity-70">Ingresa</a>
                    </div>
                @else
                    @unless($isAdmin)
                        <a href="{{ route('orders.index') }}" class="hidden text-sm font-semibold hover:opacity-70 md:inline-flex">Mis pedidos</a>
                        <a href="{{ route('cart.index') }}" class="relative p-2 hover:opacity-70" aria-label="Carrito">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @if($cartCount > 0)
                                <span class="absolute right-0 top-0 flex h-4 w-4 items-center justify-center rounded-full bg-[#3483fa] text-[10px] font-bold text-white">{{ $cartCount }}</span>
                            @endif
                        </a>
                    @endunless

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="hidden items-center rounded-md border-none px-1 py-2 text-sm font-medium transition-opacity hover:opacity-70 sm:inline-flex">
                                <span>{{ $isAdmin ? 'Admin' : $user->name }}</span>
                                <svg class="ms-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if($isAdmin)
                                <x-dropdown-link :href="route('admin.dashboard')">Panel admin</x-dropdown-link>
                                <x-dropdown-link :href="route('products.index')">Catalogo publico</x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('orders.index')">Mis pedidos</x-dropdown-link>
                                <x-dropdown-link :href="route('cart.index')">Carrito</x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')">Mi perfil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesion</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest

                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center rounded-md p-2 transition hover:opacity-70" aria-label="Abrir menu">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden h-10 items-center overflow-x-auto whitespace-nowrap text-xs font-medium sm:flex">
            @if($isAdmin)
                <a href="{{ route('admin.dashboard') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Dashboard</a>
                <a href="{{ route('products.index') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Catalogo publico</a>
                <a href="{{ route('profile.edit') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Perfil</a>
            @elseif($user)
                <a href="{{ route('products.index') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Catalogo</a>
                <a href="{{ route('orders.index') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Mis pedidos</a>
                <a href="{{ route('cart.index') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Carrito</a>
                <a href="{{ route('profile.edit') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Perfil</a>
            @else
                <a href="{{ route('products.index') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Categorias</a>
                <a href="{{ route('products.index', ['sort' => 'latest']) }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Novedades</a>
                <a href="{{ route('register') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Crear cuenta</a>
                <a href="{{ route('login') }}" class="px-6 pb-1 transition-all hover:border-b-2 hover:border-[#3483fa]">Ingresar</a>
            @endif
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden border-t border-gray-100 bg-white text-gray-800 sm:hidden">
        <div class="space-y-1 pb-3 pt-2">
            @if($isAdmin)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">Panel admin</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Catalogo publico</x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">Productos</x-responsive-nav-link>
                @auth
                    <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.*')">Mis pedidos</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.*')">Carrito</x-responsive-nav-link>
                @endauth
            @endif
        </div>

        <div class="border-t border-gray-200 pb-1 pt-4">
            @auth
                <div class="px-4">
                    <div class="text-base font-bold text-gray-800">{{ $user->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ $user->email }}</div>
                </div>
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">Mi perfil</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesion</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4 pb-4">
                    <x-responsive-nav-link :href="route('login')">Ingresa</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">Crea tu cuenta</x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
