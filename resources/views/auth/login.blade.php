<x-guest-layout>
    <!-- Background utama menggunakan abu-abu sangat muda khas dashboard modern -->
    <div class="min-h-100vh flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <!-- Brand Header -->
        <div class="mb-8 flex items-center gap-3">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center shadow-lg shadow-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tighter">SIMatrial</h1>
        </div>

        <!-- Card Login dengan border tipis & shadow halus -->
        <div class="w-full sm:max-w-md bg-white p-8 shadow-[0_1px_3px_0_rgba(0,0,0,0.1),0_1px_2px_0_rgba(0,0,0,0.06)] border border-[#e2e8f0] rounded-xl">
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-[#1e293b]">Selamat Datang</h2>
                <p class="text-sm text-[#64748b]">Silakan masuk ke akun material Anda</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[#475569] text-xs font-bold uppercase tracking-wider" />
                    <x-text-input id="email" class="block mt-1.5 w-full bg-[#fcfdfe] border-[#e2e8f0] focus:border-[#4e60ff] focus:ring-[#4e60ff] rounded-md shadow-sm text-sm p-2.5" 
                                    type="email" name="email" :value="old('email')" 
                                    required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <x-input-label for="password" :value="__('Password')" class="text-[#475569] text-xs font-bold uppercase tracking-wider" />
                    <x-text-input id="password" class="block mt-1.5 w-full bg-[#fcfdfe] border-[#e2e8f0] focus:border-[#4e60ff] focus:ring-[#4e60ff] rounded-md shadow-sm text-sm p-2.5"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <!-- Remember Me & Link -->
                <div class="flex items-center justify-between mt-6">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-[#cbd5e1] text-[#4e60ff] shadow-sm focus:ring-[#4e60ff]" name="remember">
                        <span class="ms-2 text-sm text-[#64748b]">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#4e60ff] hover:underline font-medium" href="{{ route('password.request') }}">
                            Lupa kata sandi?
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <!-- Tombol Biru Khas Avocash -->
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-[#4e60ff] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#3b4ed9] active:bg-[#3444c1] focus:outline-none focus:ring-2 focus:ring-[#4e60ff] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-blue-100">
                        Masuk ke Dashboard
                    </button>
                </div>
                 <!-- Link Balik ke Login -->
                    <a class="text-center text-sm font-semibold text-[#64748B] hover:text-[#4e60ff] transition-colors" href="{{ route('register') }}">
                        Belum punya akun? <span class="text-[#4e60ff]">Daftar di sini</span>
                    </a>
            </form>
        </div>

        <div class="mt-8 text-slate-400 text-xs">
            &copy; 2026 Material Bangunan System • v1.0
        </div>
    </div>
</x-guest-layout>
