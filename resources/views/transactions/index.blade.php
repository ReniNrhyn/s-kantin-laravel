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
                        <div class="md:mt-0 sm:flex-none w-72">
                            <form action="{{ route('transactions.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Type for search then enter"
                                    class="w-full relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300" />
                            </form>
                        </div>
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" href="{{ route('transactions.create') }}"
                                class="relative inline-flex items-center px-4 py-2 font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                                Add New Transaction
                            </a>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800 ">
                                <tr
                                    class="bg-white border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>NO</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Cashier</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Menu</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Quantity</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Total Price</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Payment Method</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Date</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span>Action</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                 @php $i = 0; @endphp
                                @forelse($transactions as $transaction)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ ++$i }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $transaction->user->name }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $transaction->menu->name }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $transaction->quantity }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ number_format($transaction->total_price, 2) }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ ucfirst($transaction->payment_method) }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            {{ $transaction->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-2 text-center">
                                            <form onsubmit="return confirm('Are you sure?');"
                                                action="{{ route('transactions.destroy', $transaction->id) }}" method="POST">
                                                <a href="{{ route('transactions.edit', $transaction->id) }}"
                                                    class="focus:outline-none text-gray-50 bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                                    DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <div class="bg-gray-500 text-white p-3 rounded shadow-sm mb-3">
                                            No transactions available!
                                        </div>
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
