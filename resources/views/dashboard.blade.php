<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Kategori -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01M5 21h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Kategori</p>
                            <p class="text-2xl font-bold text-blue-900">{{ $categoryCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Produk -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-indigo-500 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Produk</p>
                            <p class="text-2xl font-bold text-indigo-900">{{ $productCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penjualan Hari Ini -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-emerald-500 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Penjualan Hari Ini</p>
                            <p class="text-2xl font-bold text-emerald-900">Rp {{ number_format($salesToday, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pengeluaran Hari Ini -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-rose-500 p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-rose-100 text-rose-600 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Pengeluaran Hari Ini</p>
                            <p class="text-2xl font-bold text-rose-900">Rp {{ number_format($expensesToday, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Sales Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-t-2 border-blue-500">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4 text-blue-800">Transaksi Penjualan Terakhir</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-3">Tanggal</th>
                                    <th class="px-6 py-3">Tipe</th>
                                    <th class="px-6 py-3">Item</th>
                                    <th class="px-6 py-3">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSales as $sale)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-xs font-medium {{ $sale->type == 'diantar' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                                            {{ strtoupper($sale->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <ul class="list-disc list-inside">
                                            @foreach($sale->details as $detail)
                                                <li>{{ $detail->product->name }} ({{ $detail->qty }} {{ $detail->product->unit }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 font-semibold">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                @if($recentSales->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center">Belum ada transaksi.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
