<nav x-data="{ open: false }" class="bg-white">
    <!-- SIDEBAR (Kiri) - Terlihat di Desktop -->
    <aside
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 border-r border-slate-100 bg-white shadow-sm">
        <div class="h-full px-3 py-4 overflow-y-auto">
            <!-- Brand Logo -->
            <div class="flex items-center ps-2.5 mb-10 mt-2">
                <div class="bg-blue-600 p-1.5 rounded-lg me-3 shadow-md shadow-blue-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <span
                    class="self-center text-xl font-bold whitespace-nowrap text-slate-800 tracking-tight">SIMatrial</span>
            </div>

            <!-- Menu Links -->
            <ul class="space-y-1 font-medium">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mb-2">Main Menu</p>

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center p-3 rounded-xl group transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg class="w-5 h-5 transition duration-75" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>

                <!-- Master Data -->
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mt-6 mb-2">Master Data</p>
                <li>
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center p-3 rounded-xl group transition-all {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="ms-3">Kategori</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}"
                        class="flex items-center p-3 rounded-xl group transition-all {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span class="ms-3">Produk</span>
                    </a>
                </li>

                <!-- Transaksi -->
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mt-6 mb-2">Transaksi</p>
                <li>
                    <a href="{{ route('sales.index') }}"
                        class="flex items-center p-3 rounded-xl group transition-all {{ request()->routeIs('sales.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="ms-3">Penjualan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('expenses.index') }}"
                        class="flex items-center p-3 rounded-xl group transition-all {{ request()->routeIs('expenses.*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ms-3">Pengeluaran</span>
                    </a>
                </li>

                <!-- Laporan -->
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mt-6 mb-2">Laporan</p>
                <li>
                    <a href="{{ route('reports.index') }}"
                        class="flex items-center p-3 rounded-xl group transition-all {{ request()->routeIs('reports.index') ? 'bg-blue-600 text-white shadow-lg shadow-blue-100' : 'text-slate-600 hover:bg-slate-50' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="ms-3">Laporan</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- TOP HEADER -->
    <div
        class="sm:ml-64 bg-white/80 backdrop-blur-md border-b border-slate-100 fixed top-0 w-full sm:w-[calc(100%-16rem)] z-30">
        <div class="flex justify-between items-center h-20 px-4 sm:px-8">
            <!-- Left Side Title -->
            <div class="hidden sm:block">
                <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest flex items-center">
                    <span class="text-blue-600 mr-2">SIMatrial</span>
                    <span class="mx-2">/</span>
                    <span class="text-slate-800">
                        @if (request()->routeIs('dashboard'))
                            Dashboard
                        @endif
                        @if (request()->routeIs('categories.*'))
                            Kategori
                        @endif
                        @if (request()->routeIs('products.*'))
                            Produk
                        @endif
                        @if (request()->routeIs('sales.*'))
                            Penjualan
                        @endif
                        @if (request()->routeIs('expenses.*'))
                            Pengeluaran
                        @endif
                        @if (request()->routeIs('reports.*'))
                            Laporan
                        @endif
                    </span>
                </h2>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open"
                    class="p-2 rounded-xl text-slate-600 hover:bg-slate-50 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="ms-3 font-bold text-slate-800">SIMatrial</span>
            </div>

            <!-- Profile Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center gap-3 px-3 py-1.5 rounded-xl border border-slate-100 text-sm font-medium text-slate-600 bg-slate-50 hover:bg-slate-100 transition-all outline-none">
                            <div
                                class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold shadow-md shadow-blue-100">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="hidden md:block font-bold text-slate-700">{{ Auth::user()->name }}</div>
                            <svg class="fill-current h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-500">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="open" x-transition:enter="transition opacity-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" class="sm:hidden fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm"
        @click="open = false"></div>
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        class="sm:hidden fixed top-0 left-0 z-50 w-72 h-screen bg-white shadow-2xl">
        <div class="p-6 h-full overflow-y-auto">
            <div class="flex items-center mb-10">
                <div class="bg-blue-600 p-2 rounded-lg me-3">
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tighter">SIMatrial</h1>
            </div>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}"
                    class="flex items-center p-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-600' }}">
                    <span class="ms-3 font-bold">Dashboard</span>
                </a>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mt-6 mb-2">Master Data
                </p>
                <a href="{{ route('categories.index') }}"
                    class="flex items-center p-3 rounded-xl {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-600' }}">
                    <span class="ms-3 font-bold">Kategori</span>
                </a>
                <a href="{{ route('products.index') }}"
                    class="flex items-center p-3 rounded-xl {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-600' }}">
                    <span class="ms-3 font-bold">Produk</span>
                </a>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mt-6 mb-2">Transaksi</p>
                <a href="{{ route('sales.index') }}"
                    class="flex items-center p-3 rounded-xl {{ request()->routeIs('sales.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-600' }}">
                    <span class="ms-3 font-bold">Penjualan</span>
                </a>
                <a href="{{ route('expenses.index') }}"
                    class="flex items-center p-3 rounded-xl {{ request()->routeIs('expenses.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-600' }}">
                    <span class="ms-3 font-bold">Pengeluaran</span>
                </a>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest px-3 mt-6 mb-2">Sistem</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left p-3 rounded-xl text-red-500 font-bold">Log
                        Out</button>
                </form>
            </nav>
        </div>
    </div>
</nav>
