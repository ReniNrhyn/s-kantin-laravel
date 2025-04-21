<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request) // Tambahkan parameter Request
    {
        $search = $request->input('search');

        $menus = Menu::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%'.$search.'%')
                            ->orWhere('description', 'like', '%'.$search.'%');
            })
            ->latest()
            ->paginate(10);

        return view('menus.index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:food,drink,snack',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Menu::create($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu added successfully!');
    }

    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:food,drink,snack',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $menu->update($request->all());

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully!');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully!');
    }
}
