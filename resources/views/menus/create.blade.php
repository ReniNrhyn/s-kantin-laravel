<x-app-layout>
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
</x-app-layout>
