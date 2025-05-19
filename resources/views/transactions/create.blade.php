<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Transaction') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <!-- Cashier (User) -->
                        <div>
                            <x-input-label for="user_id" :value="__('Cashier')" />
                            <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                                <option value="">Select Cashier</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Menu Item -->
                        <div class="mt-4">
                            <x-input-label for="menu_id" :value="__('Menu Item')" />
                            <select id="menu_id" name="menu_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" required>
                                <option value="">Select Menu Item</option>
                                @foreach($menus as $menu)
                                    <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">{{ $menu->name }} - {{ number_format($menu->price, 2) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_id')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" :value="old('quantity', 1)" min="1" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <!-- Price Display (auto-calculated) -->
                        <div class="mt-4">
                            <x-input-label for="price_display" :value="__('Unit Price')" />
                            <x-text-input id="price_display" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" readonly />
                        </div>

                        {{-- <!-- Total Price -->
                        <div class="mt-4">
                            <x-input-label for="total_price" :value="__('Total Price')" />
                            <x-text-input id="total_price" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700" type="text" name="total_price" readonly />
                            <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                        </div> --}}

                        <!-- Total Price -->
                        <div class="mt-4">
                            <x-input-label for="total_price" :value="__('Total Price')" />
                            <x-text-input id="total_price" class="block mt-1 w-full bg-gray-100 dark:bg-gray-700"type="text"readonly />
                            <input type="hidden" name="total_price" id="total_price_hidden">
                            <x-input-error :messages="$errors->get('total_price')" class="mt-2" />
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-4">
                            <x-input-label for="payment_method" :value="__('Payment Method')" />
                            <select id="payment_method" name="payment_method" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="cash">Cash</option>
                                <option value="e-wallet">E-Wallet</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="debit_card">Debit Card</option>
                            </select>
                            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-danger-link-button class="ms-4" :href="route('transactions.index')">
                                {{ __('Back') }}
                            </x-danger-link-button>
                            <x-primary-button class="ms-4">
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuSelect = document.getElementById('menu_id');
            const quantityInput = document.getElementById('quantity');
            const priceDisplay = document.getElementById('price_display');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotal() {
                const selectedMenu = menuSelect.options[menuSelect.selectedIndex];
                const price = selectedMenu ? parseFloat(selectedMenu.dataset.price) : 0;
                const quantity = parseInt(quantityInput.value) || 0;
                const total = price * quantity;

                priceDisplay.value = price ? 'Rp ' + price.toFixed(2) : '';
                totalPriceInput.value = total ? 'Rp ' + total.toFixed(2) : '';
            }

            menuSelect.addEventListener('change', calculateTotal);
            quantityInput.addEventListener('input', calculateTotal);
        });
    </script>
    @endpush --}}

    @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuSelect = document.getElementById('menu_id');
        const quantityInput = document.getElementById('quantity');
        const unitPriceDisplay = document.getElementById('unit_price');
        const totalPriceInput = document.getElementById('total_price');
        const totalPriceHidden = document.createElement('input');
        totalPriceHidden.type = 'hidden';
        totalPriceHidden.name = 'total_price_value';
        totalPriceHidden.id = 'total_price_value';
        document.querySelector('form').appendChild(totalPriceHidden);

        function calculateTotal() {
            const selectedMenu = menuSelect.options[menuSelect.selectedIndex];
            if (selectedMenu && selectedMenu.dataset.price) {
                const price = parseFloat(selectedMenu.dataset.price);
                const quantity = parseInt(quantityInput.value) || 0;
                const total = price * quantity;

                unitPriceDisplay.value = 'Rp ' + price.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                totalPriceInput.value = 'Rp ' + total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                totalPriceHidden.value = total.toFixed(2); // Set actual value for form submission
            } else {
                unitPriceDisplay.value = '';
                totalPriceInput.value = '';
                totalPriceHidden.value = '';
            }
        }

        // Initialize event listeners
        menuSelect.addEventListener('change', calculateTotal);
        quantityInput.addEventListener('input', calculateTotal);

        // Calculate immediately if values exist
        if (menuSelect.value) {
            calculateTotal();
        }
    });
</script>
@endpush
</x-app-layout>
