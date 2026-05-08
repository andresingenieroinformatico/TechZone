<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TechZone') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <main class="min-h-screen bg-[#f5f5f5]">
            <header class="bg-[#fff159]">
                <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#3483fa] text-white shadow-sm">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </span>
                        <span class="text-2xl font-black text-[#333]">Tech<span class="text-[#3483fa]">Zone</span></span>
                    </a>

                    <a href="{{ route('products.index') }}" class="text-sm font-semibold text-[#333] hover:text-[#3483fa]">
                        Ver catalogo
                    </a>
                </div>
            </header>

            <section class="mx-auto grid min-h-[calc(100vh-4rem)] max-w-6xl items-center gap-8 px-4 py-10 sm:px-6 lg:grid-cols-[1fr_440px] lg:px-8">
                <div class="hidden lg:block">
                    <p class="mb-4 text-sm font-bold uppercase tracking-widest text-[#3483fa]">Compra tecnologia sin vueltas</p>
                    <h1 class="max-w-xl text-5xl font-black leading-tight text-gray-950">
                        Tu cuenta TechZone, lista para comprar y seguir tus pedidos.
                    </h1>
                    <div class="mt-8 grid max-w-xl grid-cols-3 gap-3">
                        <div class="rounded-lg bg-white p-4 shadow-sm">
                            <p class="text-2xl font-black text-[#3483fa]">45</p>
                            <p class="mt-1 text-sm font-medium text-gray-600">productos activos</p>
                        </div>
                        <div class="rounded-lg bg-white p-4 shadow-sm">
                            <p class="text-2xl font-black text-[#00a650]">24h</p>
                            <p class="mt-1 text-sm font-medium text-gray-600">atencion rapida</p>
                        </div>
                        <div class="rounded-lg bg-white p-4 shadow-sm">
                            <p class="text-2xl font-black text-gray-950">100%</p>
                            <p class="mt-1 text-sm font-medium text-gray-600">checkout seguro</p>
                        </div>
                    </div>
                </div>

                <div class="w-full rounded-lg bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
                    {{ $slot }}
                </div>
            </section>
        </main>
    </body>
</html>
