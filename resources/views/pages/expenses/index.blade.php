<x-app-layout>
    <div class="py-12" x-data="{
        showModal: false,
        editMode: false,
        expense: { id: null, description: '', amount: 0 },
        openModal(edit = false, data = null) {
            this.editMode = edit;
            if (edit) {
                this.expense = { ...data };
            } else {
                this.expense = { id: null, description: '', amount: 0 };
            }
            this.showModal = true;
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 px-4 sm:px-0 gap-4">
                <h2 class="text-2xl font-bold text-slate-800">Catatan Pengeluaran</h2>
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <form action="{{ route('expenses.index') }}" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full sm:w-64 pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
                            placeholder="Cari keterangan...">
                        <div
                            class="absolute left-3 top-2.5 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </form>
                    <button @click="openModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow-lg shadow-blue-100 transition-all font-semibold flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Catat Pengeluaran
                    </button>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-100">
                <div class="p-6">
                    @if (session('success'))
                        <div
                            class="mb-4 p-4 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-100 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-500">
                            <thead class="text-xs text-slate-400 uppercase bg-slate-50 border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-4 font-bold">No.</th>
                                    <th class="px-6 py-4 font-bold">Tanggal</th>
                                    <th class="px-6 py-4 font-bold">Keterangan</th>
                                    <th class="px-6 py-4 font-bold">Jumlah (Rp)</th>
                                    <th class="px-6 py-4 font-bold text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @forelse($expenses as $item)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4">{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 font-semibold text-slate-700">{{ $item->description }}</td>
                                        <td class="px-6 py-4 font-bold text-rose-600">Rp
                                            {{ number_format($item->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center items-center gap-2">
                                                <button @click="openModal(true, {{ json_encode($item) }})"
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors"
                                                    title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <form action="{{ route('expenses.destroy', $item->id) }}" method="POST"
                                                    onsubmit="return confirm('Hapus pengeluaran ini?')" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors"
                                                        title="Hapus">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data
                                            pengeluaran.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expense Modal -->
        <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="showModal" @click="showModal = false"
                    class="fixed inset-0 transition-opacity bg-slate-900 bg-opacity-40 backdrop-blur-sm"></div>

                <div x-show="showModal"
                    class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-2xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <form :action="editMode ? '{{ url('expenses') }}/' + expense.id : '{{ route('expenses.store') }}'"
                        method="POST">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="px-6 py-6 bg-white">
                            <div class="flex justify-between items-center mb-6 border-b border-slate-50 pb-4">
                                <h3 class="text-xl font-bold text-slate-800"
                                    x-text="editMode ? 'Edit Pengeluaran' : 'Catat Pengeluaran Baru'"></h3>
                                <button type="button" @click="showModal = false"
                                    class="text-slate-400 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-700 mb-1 tracking-widest uppercase">Keterangan
                                        / Deskripsi</label>
                                    <input type="text" name="description" x-model="expense.description" required
                                        placeholder="Contoh: Bayar Listrik, Gaji Karyawan, Bensin Carry"
                                        class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 transition-all outline-none">
                                </div>
                                <div>
                                    <label
                                        class="block text-sm font-bold text-slate-700 mb-1 tracking-widest uppercase">Jumlah
                                        (Rp)</label>
                                    <input type="number" name="amount" x-model="expense.amount" required
                                        placeholder="Masukkan nominal..."
                                        class="w-full px-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-rose-500 transition-all outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-slate-50 flex justify-end gap-3 rounded-b-2xl">
                            <button type="button" @click="showModal = false"
                                class="px-4 py-2 text-sm font-bold text-slate-600 hover:bg-slate-200 rounded-xl transition-all">Batal</button>
                            <button type="submit"
                                class="px-6 py-2 text-sm font-bold text-white bg-rose-500 hover:bg-rose-600 rounded-xl shadow-lg shadow-rose-100 transition-all font-semibold"
                                x-text="editMode ? 'Simpan Perubahan' : 'Simpan Pengeluaran'"></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
