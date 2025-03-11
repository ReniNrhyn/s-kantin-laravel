<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaction Management') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-sm">
                <div class="mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between py-5 mb-5">
                        <div class="sm:flex-none">
                            <a type="button" href="{{ route('transactions.create') }}"
                                class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Add New
                            </a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-center">NO</th>
                                    <th class="px-6 py-3 text-center">Menu</th>
                                    <th class="px-6 py-3 text-center">Quantity</th>
                                    <th class="px-6 py-3 text-center">Total Price</th>
                                    <th class="px-6 py-3 text-center">Payment Method</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-2 text-center">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-2 text-center">{{ $transaction->menu->name }}</td>
                                        <td class="px-6 py-2 text-center">{{ $transaction->quantity }}</td>
                                        <td class="px-6 py-2 text-center">${{ number_format($transaction->total_price, 2) }}</td>
                                        <td class="px-6 py-2 text-center">{{ $transaction->payment_method }}</td>
                                        <td class="px-6 py-2 text-center">
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                                <a href="{{ route('transactions.edit', $transaction->id) }}" class="text-yellow-500">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">No transactions available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="relative p-3">
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
