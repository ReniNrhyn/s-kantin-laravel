{{-- <x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add New Menu</h1>
    <form action="{{ route('menus.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <label class="block mb-2">Name:</label>
        <input type="text" name="name" class="border p-2 w-full mb-4" required>

        <label class="block mb-2">Category:</label>
        <select name="category" class="border p-2 w-full mb-4" required>
            <option value="food">Food</option>
            <option value="drink">Drink</option>
            <option value="snack">Snack</option>
        </select>

        <label class="block mb-2">Description:</label>
        <textarea name="description" class="border p-2 w-full mb-4"></textarea>

        <label class="block mb-2">Price:</label>
        <input type="number" name="price" step="0.01" class="border p-2 w-full mb-4" required>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Menu</button>
    </form>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('menus.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Menu Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Category -->
                            <div>
                                <x-input-label for="category" :value="__('Category')" />
                                <select id="category" name="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="food">Food</option>
                                    <option value="drink">Drink</option>
                                    <option value="snack">Snack</option>
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <!-- Price -->
                            <div>
                                <x-input-label for="price" :value="__('Price')" />
                                <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" required />
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <x-input-label for="description" :value="__('Description (Optional)')" />
                                <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('menus.index') }}" class="mr-4 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Save') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
