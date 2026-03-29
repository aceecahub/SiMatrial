<x-app-layout>
    <div class="py-12" x-data="{ 
        showModal: false, 
        type: 'diambil',
        shipping_cost: 0,
        items: [],
        products: {{ json_encode($products) }},
        
        addItem() {
            this.items.push({ product_id: '', qty: 1, name: '', price: 0, stock: 0 });
        },
        
        removeItem(index) {
            this.items.splice(index, 1);
        },

        updateItemDetails(index) {
            const prod = this.products.find(p => p.id == this.items[index].product_id);
            if (prod) {
                this.items[index].name = prod.name;
                this.items[index].price = prod.price_sell;
                this.items[index].stock = prod.stock;
                this.items[index].unit = prod.unit;
            }
        },

        get total() {
            let sum =  this.items.reduce((acc, item) => acc + (item.price * item.qty), 0);
            if (this.type === 'diantar') {
                sum += parseFloat(this.shipping_cost || 0);
            }
            return sum;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 px-4 sm:px-0 gap-4">
                <h2 class="text-2xl font-bold text-slate-800">Transaksi Penjualan</h2>
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <form action="{{ route('sales.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="w-full sm:w-64 pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none" 
                               placeholder="Cari tipe (diambil/diantar)...">
                        <div class="absolute left-3 top-2.5 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                    </form>
                    <button @click="showModal = true; items = []; addItem()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow-lg shadow-blue-100 transition-all font-semibold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Input Penjualan
                    </button>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-rose-50 text-rose-700 rounded-xl border border-rose-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-400 uppercase bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4 font-bold">No.</th>
                                    <th class="px-6 py-4 font-bold">Waktu</th>
                                    <th class="px-6 py-4 font-bold">Tipe</th>
                                    <th class="px-6 py-4 font-bold">Item & Qty</th>
                                    <th class="px-6 py-4 font-bold">Ongkir</th>
                                    <th class="px-6 py-4 font-bold">Total Transaksi</th>
                                    <th class="px-6 py-4 font-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($sales as $item)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-slate-600">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-lg text-xs font-bold {{ $item->type == 'diantar' ? 'bg-orange-50 text-orange-600 border border-orange-100' : 'bg-blue-50 text-blue-600 border border-blue-100' }}">
                                            {{ strtoupper($item->type) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <ul class="text-xs space-y-1">
                                            @foreach($item->details as $detail)
                                                <li>- <span class="font-bold text-slate-700">{{ $detail->product->name }}</span> ({{ $detail->qty }} {{ $detail->product->unit }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">Rp {{ number_format($item->shipping_cost, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 font-bold text-slate-800">Rp {{ number_format($item->total_price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-center">
                                            <form action="{{ route('sales.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini? Stok akan dikembalikan ke produk.')" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-slate-400">Belum ada data transaksi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Sale Modal -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" @click="showModal = false" class="fixed inset-0 transition-opacity bg-slate-900 bg-opacity-40 backdrop-blur-sm"></div>

                <div x-show="showModal" class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div class="px-6 py-6 bg-white">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-xl font-bold text-slate-800">Lakukan Penjualan</h3>
                                <button type="button" @click="showModal = false" class="text-slate-400 transition-colors hover:text-slate-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            </div>

                            <!-- Purchase Info -->
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Jenis Transaksi</label>
                                    <select name="type" x-model="type" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                                        <option value="diambil">Diambil di Toko</option>
                                        <option value="diantar">Diantar / COD (Kirim)</option>
                                    </select>
                                </div>
                                <div x-show="type === 'diantar'">
                                    <label class="block text-sm font-bold text-slate-700 mb-1">Ongkos Kirim (Rp)</label>
                                    <input type="number" name="shipping_cost" x-model="shipping_cost" class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 transition-all outline-none">
                                </div>
                            </div>

                            <!-- Cart Items -->
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <label class="text-sm font-bold text-slate-700 uppercase tracking-widest">Produk yang Dibeli</label>
                                    <button type="button" @click="addItem()" class="text-blue-600 text-sm font-bold hover:underline">+ Tambah Barang</button>
                                </div>
                                <div class="space-y-3">
                                    <template x-for="(item, index) in items" :key="index">
                                        <div class="flex items-center gap-2 bg-slate-50 p-3 rounded-2xl border border-slate-100">
                                            <div class="flex-grow">
                                                <select :name="'items['+index+'][product_id]'" x-model="item.product_id" @change="updateItemDetails(index)" required class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-sm outline-none">
                                                    <option value="">Pilih Produk</option>
                                                    @foreach($products as $prod)
                                                        <option value="{{ $prod->id }}">{{ $prod->name }} (Rp{{ number_format($prod->price_sell, 0, ',', '.') }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="w-24">
                                                <input type="number" :name="'items['+index+'][qty]'" x-model="item.qty" placeholder="Qty" required min="1" class="w-full px-3 py-1.5 border border-slate-200 rounded-lg text-sm outline-none">
                                            </div>
                                            <div class="w-28 text-right text-xs">
                                                <div class="text-slate-400">Total</div>
                                                <div class="font-bold text-blue-600" x-text="'Rp ' + (item.price * item.qty).toLocaleString()"></div>
                                            </div>
                                            <button type="button" @click="removeItem(index)" class="p-1 text-rose-500 hover:bg-rose-100 rounded">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            </button>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Total Summary -->
                        <div class="px-6 py-4 bg-slate-50 flex justify-between items-center rounded-b-2xl border-t border-slate-100">
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-widest">Grand Total</div>
                                <div class="text-2xl font-black text-blue-900" x-text="'Rp ' + total.toLocaleString()"></div>
                            </div>
                            <div class="flex gap-3">
                                <button type="button" @click="showModal = false" class="px-6 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
                                <button type="submit" class="px-6 py-2 text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl shadow-lg transition-all" :disabled="items.length === 0">Simpan Transaksi</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
