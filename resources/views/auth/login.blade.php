<x-guest-layout>
    <div class="mb-8">
        <p class="text-sm font-bold uppercase tracking-widest text-[#3483fa]">Bienvenido de nuevo</p>
        <h2 class="mt-2 text-3xl font-black text-gray-950">Ingresa a tu cuenta</h2>
        <p class="mt-2 text-sm text-gray-500">Continua tus compras, revisa tu carrito y administra tus pedidos.</p>
    </div>

    <x-auth-session-status class="mb-5 rounded-lg bg-green-50 p-3 text-green-700" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="mb-2 block text-sm font-bold text-gray-800">Correo electronico</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18a2 2 0 002-2V8a2 2 0 00-2-2H3a2 2 0 00-2 2v6a2 2 0 002 2z" />
                    </svg>
                </span>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="correo@ejemplo.com" class="w-full rounded-lg border-gray-300 py-3 pl-11 pr-4 text-sm shadow-sm focus:border-[#3483fa] focus:ring-[#3483fa]">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <div class="mb-2 flex items-center justify-between gap-4">
                <label for="password" class="block text-sm font-bold text-gray-800">Contrasena</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-[#3483fa] hover:text-[#2968c8]">
                        Olvide mi contrasena
                    </a>
                @endif
            </div>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 10-4 0v2c0 1.104.896 2 2 2zm-6 0h12v9H6v-9z" />
                    </svg>
                </span>
                <input id="password" name="password" type="password" required autocomplete="current-password" placeholder="Tu contrasena" class="w-full rounded-lg border-gray-300 py-3 pl-11 pr-4 text-sm shadow-sm focus:border-[#3483fa] focus:ring-[#3483fa]">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <label for="remember_me" class="flex items-center gap-3 rounded-lg border border-gray-200 bg-gray-50 px-3 py-3">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#3483fa] focus:ring-[#3483fa]">
            <span class="text-sm font-medium text-gray-700">Mantener sesion iniciada</span>
        </label>

        <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-lg bg-[#3483fa] px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-[#2968c8] focus:outline-none focus:ring-2 focus:ring-[#3483fa] focus:ring-offset-2">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m12 0l-4-4m4 4l-4 4m5-11h3a2 2 0 012 2v10a2 2 0 01-2 2h-3" />
            </svg>
            Entrar
        </button>
    </form>

    <div class="mt-6 border-t border-gray-100 pt-6 text-center">
        <p class="text-sm text-gray-600">
            No tienes cuenta?
            <a href="{{ route('register') }}" class="font-bold text-[#3483fa] hover:text-[#2968c8]">Crear cuenta</a>
        </p>
    </div>
</x-guest-layout>
