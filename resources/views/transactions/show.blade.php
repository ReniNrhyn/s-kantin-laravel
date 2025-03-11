<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cetak Struk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white p-6 shadow-md rounded-md text-gray-800">
            <h3 class="text-lg font-semibold">Nomor Invoice: {{ $transaction->invoice }}</h3>
            <p class="text-sm">Tanggal: {{ $transaction->created_at->format('d M Y, H:i') }}</p>
            <p class="text-sm">Kasir: {{ $transaction->cashier->name }}</p>
            <hr class="my-4">

            <h4 class="font-semibold">Detail Pembelian:</h4>
            <table class="w-full text-sm text-gray-700 mt-2">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-2 py-1 text-left">Menu</th>
                        <th class="px-2 py-1 text-right">Jumlah</th>
                        <th class="px-2 py-1 text-right">Harga</th>
                        <th class="px-2 py-1 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaction->items as $item)
                        <tr>
                            <td class="px-2 py-1">{{ $item->menu->name }}</td>
                            <td class="px-2 py-1 text-right">{{ $item->quantity }}</td>
                            <td class="px-2 py-1 text-right">Rp{{ number_format($item->menu->price, 0, ',', '.') }}</td>
                            <td class="px-2 py-1 text-right">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr class="my-4">

            <p class="font-semibold">Total Harga: Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</p>
            <p>Metode Pembayaran: {{ $transaction->payment_method }}</p>
            <p>Status: <span class="font-bold text-green-600">{{ strtoupper($transaction->status) }}</span></p>

            <div class="mt-4">
                <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Cetak Struk</button>
            </div>
        </div>
    </div>
</x-app-layout>
