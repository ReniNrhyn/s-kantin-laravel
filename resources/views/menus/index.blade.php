<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Menu List</h1>
    <a href="{{ route('menus.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Menu</a>

    @if(session('success'))
        <p class="text-green-500 mt-2">{{ session('success') }}</p>
    @endif

    <table class="w-full mt-4 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Description</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
                <tr class="border">
                    <td class="border px-4 py-2">{{ $menu->name }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($menu->category) }}</td>
                    <td class="border px-4 py-2">{{ $menu->description }}</td>
                    <td class="border px-4 py-2">Rp {{ number_format($menu->price, 2) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-500">Edit</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
