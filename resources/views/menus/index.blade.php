<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menu Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <div class="w-72">
                            <form action="{{ route('menus.index') }}" method="GET">
                                <input type="text" name="search" placeholder="Search menu..."
                                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </form>
                        </div>
                        <!-- Add New Menu -->
                        <div class="flex justify-end space-x-2 mb-4">
                            <a href="{{ route('menus.create') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                Add New Menu
                            </a>
                            <!-- Download PDF -->
                            <a href="{{ route('menus.report-pdf') }}"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                Download PDF
                            </a>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Category</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Description</th>
                                    <th scope="col" class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menus as $index => $menu)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        {{ $menu->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $menu->category == 'food' ? 'bg-green-100 text-green-800' :
                                               ($menu->category == 'drink' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($menu->category) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        Rp {{ number_format($menu->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 max-w-xs truncate">
                                        {{ $menu->description ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('menus.edit', $menu->id) }}"
                                               class="text-yellow-600 hover:text-yellow-900">
                                                Edit
                                            </a>
                                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
                                                  onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <div class="bg-gray-500 text-white p-3 rounded shadow-sm mb-3">
                                        Data Belum Tersedia!
                                    </div>
                                {{-- <tr>
                                    <td colspan="6" class="px-6 py-4 text-center">No menus found</td>
                                </tr> --}}
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($menus->hasPages())
                    <div class="mt-4">
                        {{ $menus->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
