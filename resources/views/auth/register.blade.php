<x-guest-layout>
    <!-- Background Full Clean ala Avocash -->
    <div class="min-h-auto flex flex-col justify-center items-center font-sans antialiased py-2">
        
        <!-- Header Brand -->
        <div class="mb-6 flex flex-col items-center">
            <div class="bg-[#4e60ff] p-3 rounded-xl shadow-lg shadow-blue-200 mb-3">
                <svg xmlns="http://www.w3.org" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-[#1E293B]">DAFTAR<span class="text-[#4e60ff]">AKUN</span></h1>
        </div>

        <!-- Register Card -->
        <div class="w-full sm:max-w-md bg-white px-10 py-10 border border-[#E2E8F0] rounded-2xl shadow-sm">
            
            <div class="mb-8">
                <h2 class="text-xl font-bold text-[#334155]">Buat Akun Baru</h2>
                <p class="text-sm text-[#64748B] mt-1">Gabung dengan sistem MaterialHub hari ini.</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-5">
                    <label for="name" class="block text-xs font-bold text-[#475569] uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input id="name" 
                           class="block w-full px-4 py-3 bg-[#F8FAFC] border border-[#E2E8F0] text-[#1E293B] rounded-lg focus:ring-2 focus:ring-[#4e60ff] focus:border-transparent transition-all outline-none" 
                           type="text" name="name" :value="old('name')" 
                           placeholder="Contoh: Budi Santoso"
                           required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs" />
                </div>

                <!-- Email Address -->
                <div class="mb-5">
                    <label for="email" class="block text-xs font-bold text-[#475569] uppercase tracking-widest mb-2">Email</label>
                    <input id="email" 
                           class="block w-full px-4 py-3 bg-[#F8FAFC] border border-[#E2E8F0] text-[#1E293B] rounded-lg focus:ring-2 focus:ring-[#4e60ff] focus:border-transparent transition-all outline-none" 
                           type="email" name="email" :value="old('email')" 
                           placeholder="nama@email.com"
                           required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs" />
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="block text-xs font-bold text-[#475569] uppercase tracking-widest mb-2">Password</label>
                    <input id="password" 
                           class="block w-full px-4 py-3 bg-[#F8FAFC] border border-[#E2E8F0] text-[#1E293B] rounded-lg focus:ring-2 focus:ring-[#4e60ff] focus:border-transparent transition-all outline-none"
                           type="password"
                           name="password"
                           placeholder="Minimal 8 karakter"
                           required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="block text-xs font-bold text-[#475569] uppercase tracking-widest mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" 
                           class="block w-full px-4 py-3 bg-[#F8FAFC] border border-[#E2E8F0] text-[#1E293B] rounded-lg focus:ring-2 focus:ring-[#4e60ff] focus:border-transparent transition-all outline-none"
                           type="password"
                           name="password_confirmation" 
                           placeholder="Ulangi password"
                           required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs" />
                </div>

                <div class="flex flex-col gap-4">
                    <!-- Tombol Register -->
                    <button type="submit" class="w-full py-4 bg-[#4e60ff] hover:bg-[#3b4ed9] text-white font-bold rounded-xl shadow-lg shadow-blue-100 transition-all active:transform active:scale-[0.98]">
                        DAFTAR SEKARANG
                    </button>

                    <!-- Link Balik ke Login -->
                    <a class="text-center text-sm font-semibold text-[#64748B] hover:text-[#4e60ff] transition-colors" href="{{ route('login') }}">
                        Sudah punya akun? <span class="text-[#4e60ff]">Masuk di sini</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-[#94A3B8] text-xs font-medium tracking-tight">
            © 2026 MATERIALHUB MANAGEMENT SYSTEM
        </div>
    </div>
</x-guest-layout>
