<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-bold uppercase tracking-widest text-[#3483fa]">Nueva cuenta</p>
        <h2 class="mt-2 text-3xl font-black text-gray-950">Registrate en TechZone</h2>
        <p class="mt-2 text-sm text-gray-500">Crea tu perfil para guardar tu carrito y comprar tecnologia mas rapido.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="mb-2 block text-sm font-bold text-gray-800">Nombre completo</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Tu nombre" class="w-full rounded-lg border-gray-300 py-3 pl-11 pr-4 text-sm shadow-sm focus:border-[#3483fa] focus:ring-[#3483fa]">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="mb-2 block text-sm font-bold text-gray-800">Correo electronico</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                </span>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username" placeholder="correo@ejemplo.com" class="w-full rounded-lg border-gray-300 py-3 pl-11 pr-4 text-sm shadow-sm focus:border-[#3483fa] focus:ring-[#3483fa]">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="mb-2 block text-sm font-bold text-gray-800">Contrasena</label>
                <input id="password" name="password" type="password" required autocomplete="new-password" placeholder="Minimo 8 caracteres" class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-[#3483fa] focus:ring-[#3483fa]">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <label for="password_confirmation" class="mb-2 block text-sm font-bold text-gray-800">Confirmar</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="Repite tu clave" class="w-full rounded-lg border-gray-300 px-4 py-3 text-sm shadow-sm focus:border-[#3483fa] focus:ring-[#3483fa]">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 text-sm font-medium text-blue-900">
            Tu cuenta se crea como cliente. Desde ahi puedes comprar, revisar pedidos y administrar tu perfil.
        </div>

        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#3483fa] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#2968c8] focus:outline-none focus:ring-2 focus:ring-[#3483fa] focus:ring-offset-2">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3M13 7a4 4 0 11-8 0 4 4 0 018 0zM3 21a6 6 0 0112 0" />
            </svg>
            Crear cuenta
        </button>
    </form>

    <div class="mt-6 border-t border-gray-100 pt-6 text-center">
        <p class="text-sm text-gray-600">
            Ya tienes cuenta?
            <a href="{{ route('login') }}" class="font-bold text-[#3483fa] hover:text-[#2968c8]">Ingresar</a>
        </p>
    </div>
</x-guest-layout>
