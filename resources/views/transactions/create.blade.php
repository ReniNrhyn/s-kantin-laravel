<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Input Transaksi') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <!-- Pilih Menu -->
                        <div>
                            <x-input-label for="menu" :value="__('Menu')" />
                            <select id="menu" name="menu_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="">-- Pilih Menu --</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_id')" class="mt-2" />
                        </div>

                        <!-- Input Jumlah -->
                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Jumlah')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" min="1" value="1" required />
                        </div>

                        <!-- Total Harga (Readonly) -->
                        <div class="mt-4">
                            <x-input-label for="total_price" :value="__('Total Harga')" />
                            <x-text-input id="total_price" class="block mt-1 w-full bg-gray-200" type="text" name="total_price" readonly />
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mt-4">
                            <x-input-label for="payment_method" :value="__('Metode Pembayaran')" />
                            <select id="payment_method" name="payment_method" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="cash">Cash</option>
                                <option value="e-wallet">E-Wallet</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-button type="reset" class="ms-4">
                                {{ __('Reset') }}
                            </x-danger-button>
                            <x-primary-button class="ms-4">
                                {{ __('Submit') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('menu').addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            let price = selectedOption.getAttribute('data-price');
            let quantity = document.getElementById('quantity').value;
            document.getElementById('total_price').value = price * quantity;
        });

        document.getElementById('quantity').addEventListener('input', function () {
            let price = document.getElementById('menu').options[document.getElementById('menu').selectedIndex].getAttribute('data-price');
            document.getElementById('total_price').value = price * this.value;
        });
    </script>
</x-app-layout>
