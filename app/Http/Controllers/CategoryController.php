<?php

namespace App\Http\Controllers; // namespace menentukan lokasi controller dalam struktur Laravel.

use App\Models\Category; // use mengimpor class yang dibutuhkan: // Category model untuk interaksi dengan tabel categories.
use Illuminate\Http\Request; // Request untuk menangani data input HTTP.

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() // Menampilkan daftar kategori dengan fitur pencarian dan pagination.
    {
        $categories = Category::when(request()->search, function ($query) {
            // when(): Mengeksekusi query pencarian hanya jika parameter search ada.
            $query->where('category_name', 'like', '%' . request()->search . '%');
            // where('category_name', 'like', '%...%'): Mencari kategori berdasarkan nama (partial match).
        })->paginate(10); // Membagi data menjadi 10 item per halaman.

        return view('categories.index', compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 10); // Menghitung nomor urut untuk pagination.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() // Menampilkan form untuk menambah kategori baru.
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) // Menyimpan kategori baru ke database.
    {
        $request->validate([
            'category_name' => 'required|string|unique:categories',
            'description' => 'nullable|string'
        ]);

        try {
            $category = Category::create([
                'category_name' => $request->category_name,
                'description' => $request->description
            ]);

            return redirect()->route('categories.index') // Redirect ke halaman index dengan pesan sukses.
                ->with('success', 'Category "' . $category->category_name . '" has been added successfully!');
        } catch (\Throwable $th) { // Menangani error dan mengembalikan pesan error.
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category) // Menampilkan form edit untuk kategori yang dipilih.
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category) // Memperbarui data kategori yang ada.
    {
        $request->validate([
            'category_name' => 'required|string|unique:categories,category_name,'.$category->id,
            'description' => 'nullable|string'
        ]);

        try {
            $category->update([
                'category_name' => $request->category_name,
                'description' => $request->description
            ]);

            return redirect()->route('categories.index')
                ->with('success', 'Category "' . $category->category_name . '" has been updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) // Menghapus kategori dari database.
    {
        try {
            $categoryName = $category->category_name;
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Category "' . $categoryName . '" has been deleted successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
