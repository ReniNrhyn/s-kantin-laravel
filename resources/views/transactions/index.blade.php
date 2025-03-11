<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">

                    <!-- Filter Tanggal -->
                    <div class="flex items-center justify-between py-5 mb-5">
                        <form action="{{ route('transactions.index') }}" method="GET">
                            <input type="date" name="date" value="{{ request('date') }}"
                                class="w-72 px-4 py-2 border rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800">
                            <button type="submit"
                                class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Filter</button>
                        </form>
                        <div>
                            <a href="{{ route('transactions.export', 'pdf') }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Export PDF</a>
                            <a href="{{ route('transactions.export', 'excel') }}"
                                class="ml-2 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">Export Excel</a>
                        </div>
                    </div>

                    <!-- Tabel Daftar Transaksi -->
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-center">No</th>
                                    <th class="px-6 py-3 text-center">Invoice</th>
                                    <th class="px-6 py-3 text-center">Kasir</th>
                                    <th class="px-6 py-3 text-center">Menu</th>
                                    <th class="px-6 py-3 text-center">Jumlah</th>
                                    <th class="px-6 py-3 text-center">Total Harga</th>
                                    <th class="px-6 py-3 text-center">Metode Pembayaran</th>
                                    <th class="px-6 py-3 text-center">Status</th>
                                    <th class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $key => $transaction)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 text-center">{{ $key + 1 }}</td>
                                        <td class="px-6 py-4 text-center">{{ $transaction->invoice }}</td>
                                        <td class="px-6 py-4 text-center">{{ $transaction->cashier->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $transaction->menu->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $transaction->quantity }}</td>
                                        <td class="px-6 py-4 text-center">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 text-center">{{ $transaction->payment_method }}</td>
                                        <td class="px-6 py-4 text-center">{{ $transaction->status }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('transactions.show', $transaction->id) }}"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Lihat Detail</a>
                                            @if(auth()->user()->role === 'admin')
                                                <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700"
                                                        onclick="return confirm('Yakin ingin menghapus transaksi ini?');">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center">Data transaksi belum tersedia.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="p-3">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
