<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex space-x-4">
                            <form action="{{ route('transactions.index') }}" method="GET">
                                <input type="date" name="date" value="{{ request('date') }}"
                                    class="rounded-md border-gray-300 shadow-sm">
                                <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded-md">
                                    Filter
                                </button>
                            </form>

                            <form action="{{ route('transactions.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Cari invoice..."
                                    value="{{ request('search') }}"
                                    class="rounded-md border-gray-300 shadow-sm">
                            </form>
                        </div>

                        <a href="{{ route('transactions.create') }}"
                           class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            + Transaksi Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Invoice</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Menu</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                                @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->invoice_number }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->formatted_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->menu->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $transaction->formatted_total }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $transaction->payment_method == 'cash' ? 'bg-green-100 text-green-800' :
                                               ($transaction->payment_method == 'e-wallet' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800') }}">
                                            {{ $transaction->payment_method }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full
                                            {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-800' :
                                               ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $transaction->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('transactions.show', $transaction) }}"
                                               class="text-blue-600 hover:text-blue-900">
                                                Detail
                                            </a>
                                            <a href="{{ route('transactions.edit', $transaction) }}"
                                               class="text-yellow-600 hover:text-yellow-900">
                                                Edit
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Hapus transaksi ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 text-center">Tidak ada data transaksi</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
