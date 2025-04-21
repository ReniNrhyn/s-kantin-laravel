<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Stok') }}
            @if($lowStockCount = Stock::whereColumn('quantity', '<=', 'min_stock')->count())
                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full ml-2">
                    {{ $lowStockCount }} Stok Rendah
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between mb-4">
                        <form class="flex gap-2">
                            <input type="text" name="search" placeholder="Cari stok..."
                                   value="{{ request('search') }}"
                                   class="rounded-md border-gray-300 shadow-sm">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                Cari
                            </button>
                        </form>
                        <a href="{{ route('stocks.create') }}"
                           class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            + Tambah Stok
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left">Nama</th>
                                <th class="px-6 py-3 text-left">Jumlah</th>
                                <th class="px-6 py-3 text-left">Min. Stok</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Pemasok</th>
                                <th class="px-6 py-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($stocks as $stock)
                            <tr class="{{ $stock->is_low ? 'bg-red-50' : '' }}">
                                <td class="px-6 py-4">{{ $stock->name }}</td>
                                <td class="px-6 py-4">{{ $stock->quantity }} {{ $stock->unit }}</td>
                                <td class="px-6 py-4">{{ $stock->min_stock }} {{ $stock->unit }}</td>
                                <td class="px-6 py-4">
                                    @if($stock->is_low)
                                        <span class="text-red-600 font-bold">Rendah</span>
                                    @else
                                        <span class="text-green-600">Aman</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $stock->supplier?->name ?? '-' }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('stocks.edit', $stock) }}"
                                       class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('stocks.destroy', $stock) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Hapus stok ini?')">Hapus</button>
                                    </form>
                                    <a href="{{ route('stocks.history', $stock) }}"
                                       class="text-blue-600 hover:text-blue-900">Riwayat</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $stocks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
