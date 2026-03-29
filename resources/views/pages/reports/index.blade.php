<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header & Filter -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 px-4 sm:px-0 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Laporan & Laba Rugi</h2>
                    <p class="text-sm text-slate-500 font-medium tracking-wide uppercase">Periode: {{ date('d M Y', strtotime($startDate)) }} - {{ date('d M Y', strtotime($endDate)) }}</p>
                </div>
                
                <form action="{{ route('reports.index') }}" method="GET" class="bg-white p-3 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Dari</label>
                        <input type="date" name="start_date" value="{{ $startDate }}" class="px-3 py-1.5 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-widest">Sampai</label>
                        <input type="date" name="end_date" value="{{ $endDate }}" class="px-3 py-1.5 border border-slate-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-xl shadow-lg shadow-blue-100 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </button>
                </form>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-emerald-500 relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5 text-emerald-900">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10v2a2 2 0 002 2V6a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h4a2 2 0 110 4H8a2 2 0 01-2-2zm11-3a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" /></svg>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Laba Kotor (Revenue - Modal)</p>
                    <h3 class="text-2xl font-black text-emerald-600">Rp {{ number_format($labaKotor, 0, ',', '.') }}</h3>
                    <p class="text-[10px] text-slate-400 mt-2">* Belum dikurangi biaya operasional/pengeluaran.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-rose-500 relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5 text-rose-900">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Pengeluaran</p>
                    <h3 class="text-2xl font-black text-rose-600">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</h3>
                    <p class="text-[10px] text-slate-400 mt-2">* Meliputi operasional, gaji, listrik, bensin, dll.</p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 border-l-4 border-blue-600 relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5 text-blue-900">
                         <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" /></svg>
                    </div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Laba Bersih (Profit)</p>
                    <h3 class="text-3xl font-black {{ $labaBersih >= 0 ? 'text-blue-700' : 'text-rose-700' }}">Rp {{ number_format($labaBersih, 0, ',', '.') }}</h3>
                    <p class="text-[10px] text-slate-400 mt-2">* Keuntungan murni yang didapatkan.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Sales List -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h4 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                        <span class="w-2 h-6 bg-blue-600 rounded-full mr-3"></span>
                        Detail Penjualan
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                             <thead class="text-xs text-slate-400 uppercase border-b border-slate-50">
                                <tr>
                                    <th class="py-3 font-bold">Waktu</th>
                                    <th class="py-3 font-bold">Produk</th>
                                    <th class="py-3 font-bold text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($sales as $sale)
                                <tr>
                                    <td class="py-4 text-xs">{{ $sale->created_at->format('d/m H:i') }}</td>
                                    <td class="py-4">
                                        <div class="text-xs space-y-1">
                                            @foreach($sale->details as $d)
                                                <div><span class="font-bold text-slate-700">{{ $d->product->name }}</span> ({{ $d->qty }})</div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-4 text-right font-bold text-slate-800 text-xs">Rp{{ number_format($sale->total_price, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="py-8 text-center text-slate-400">Belum ada penjualan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Expenses List -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                    <h4 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                        <span class="w-2 h-6 bg-rose-500 rounded-full mr-3"></span>
                        Detail Pengeluaran
                    </h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-400 uppercase border-b border-slate-50">
                                <tr>
                                    <th class="py-3 font-bold">Tanggal</th>
                                    <th class="py-3 font-bold">Deskripsi</th>
                                    <th class="py-3 font-bold text-right">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($expenses as $exp)
                                <tr>
                                    <td class="py-4 text-xs">{{ $exp->created_at->format('d/m/Y') }}</td>
                                    <td class="py-4 text-xs font-semibold text-slate-700 uppercase tracking-tighter">{{ $exp->description }}</td>
                                    <td class="py-4 text-right font-bold text-rose-600 text-xs text-nowrap">Rp {{ number_format($exp->amount, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="py-8 text-center text-slate-400">Belum ada pengeluaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
