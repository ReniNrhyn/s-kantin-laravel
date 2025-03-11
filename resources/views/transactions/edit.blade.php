<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Kasir -->
                        <div>
                            <x-input-label for="user_id" :value="__('Cashier')" />
                            <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                @foreach ($cashiers as $cashier)
                                    <option value="{{ $cashier->id }}" {{ $transaction->user_id == $cashier->id ? 'selected' : '' }}>
                                        {{ $cashier->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Menu -->
                        <div class="mt-4">
                            <x-input-label for="menu_id" :value="__('Menu')" />
                            <select id="menu_id" name="menu_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ $transaction->menu_id == $menu->id ? 'selected' : '' }}>
                                        {{ $menu->name }} - Rp{{ number_format($menu->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('menu_id')" class="mt-2" />
                        </div>

                        <!-- Quantity -->
                        <div class="mt-4">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" class="block mt-1 w-full" type="number" name="quantity" min="1" value="{{ $transaction->quantity }}" required />
                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                        </div>

                        <!-- Payment Method -->
                        <div class="mt-4">
                            <x-input-label for="payment_method" :value="__('Payment Method')" />
                            <select id="payment_method" name="payment_method" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                                <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                                <option value="e-wallet" {{ $transaction->payment_method == 'e-wallet' ? 'selected' : '' }}>E-Wallet</option>
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
</x-app-layout>
