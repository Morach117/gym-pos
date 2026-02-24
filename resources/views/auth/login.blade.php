<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gym-dark">
        
        <div class="mb-8">
            <h1 class="text-5xl font-black italic tracking-tighter text-white uppercase">
                GYM<span class="text-gym-neon">CORE</span>
            </h1>
            <div class="h-1 w-full bg-gym-neon shadow-neon-glow mt-1"></div>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-gray-900 border border-gray-800 rounded-2xl shadow-2xl relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-24 h-24 bg-gym-neon opacity-10 rounded-full blur-3xl"></div>

            <h2 class="text-white text-xl font-bold mb-6 text-center uppercase tracking-widest">Acceso Sistema</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="username" class="block text-xs font-black uppercase text-gym-neon mb-1 tracking-widest">Usuario</label>
                    <input id="username" type="text" name="username" :value="old('username')" required autofocus 
                        class="w-full bg-gym-dark border-gray-700 text-white focus:border-gym-neon focus:ring-gym-neon rounded-lg transition-all shadow-inner" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-xs font-black uppercase text-gym-neon mb-1 tracking-widest">Contraseña</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" 
                        class="w-full bg-gym-dark border-gray-700 text-white focus:border-gym-neon focus:ring-gym-neon rounded-lg transition-all shadow-inner" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-gym-dark border-gray-700 text-gym-neon focus:ring-gym-neon" name="remember">
                        <span class="ms-2 text-sm text-gray-400 font-bold uppercase text-[10px]">Recordar</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-[10px] text-gray-500 hover:text-gym-neon font-bold uppercase tracking-tighter transition-colors" href="{{ route('password.request') }}">
                            ¿Olvidaste tu clave?
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <button class="w-full bg-gym-neon hover:bg-white text-black font-black py-3 rounded-lg uppercase tracking-widest transition-all shadow-neon-glow active:scale-95">
                        Entrar al Sistema
                    </button>
                </div>
            </form>
        </div>
        
        <p class="mt-8 text-gray-600 text-[10px] uppercase font-bold tracking-widest">
            Desarrollado por <span class="text-gray-400">Software Architect</span>
        </p>
    </div>
</x-guest-layout>