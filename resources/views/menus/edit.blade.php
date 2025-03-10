<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Menu</h1>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        @method('PUT')

        <label class="block mb-2">Name:</label>
        <input type="text" name="name" value="{{ $menu->name }}" class="border p-2 w-full mb-4" required>

        <label class="block mb-2">Category:</label>
        <select name="category" class="border p-2 w-full mb-4" required>
            <option value="food" {{ $menu->category == 'food' ? 'selected' : '' }}>Food</option>
            <option value="drink" {{ $menu->category == 'drink' ? 'selected' : '' }}>Drink</option>
            <option value="snack" {{ $menu->category == 'snack' ? 'selected' : '' }}>Snack</option>
        </select>

        <label class="block mb-2">Description:</label>
        <textarea name="description" class="border p-2 w-full mb-4">{{ $menu->description }}</textarea>

        <label class="block mb-2">Price:</label>
        <input type="number" name="price" step="0.01" value="{{ $menu->price }}" class="border p-2 w-full mb-4" required>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update Menu</button>
    </form>
</x-app-layout>
