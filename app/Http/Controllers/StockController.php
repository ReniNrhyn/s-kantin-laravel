<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockHistory;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('supplier')
            ->when(request('search'), fn($q) => $q->where('name', 'like', '%'.request('search').'%'))
            ->orderByRaw('quantity <= min_stock DESC') // Stok rendah di atas
            ->paginate(10);

        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('stocks.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:ingredient,menu',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'required|string|max:20',
            'min_stock' => 'required|numeric|min:0',
            'price_per_unit' => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'notes' => 'nullable|string'
        ]);

        $stock = Stock::create($data);

        // Catat riwayat
        StockHistory::create([
            'stock_id' => $stock->id,
            'quantity_change' => $stock->quantity,
            'type' => 'initial',
            'user_id' => auth()->id(),
            'notes' => 'Stok awal'
        ]);

        return redirect()->route('stocks.index')
            ->with('success', 'Stok berhasil ditambahkan!');
    }

    public function edit(Stock $stock)
    {
        $suppliers = Supplier::all();
        return view('stocks.edit', compact('stock', 'suppliers'));
    }

    public function update(Request $request, Stock $stock)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:ingredient,menu',
            'unit' => 'required|string|max:20',
            'min_stock' => 'required|numeric|min:0',
            'price_per_unit' => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'notes' => 'nullable|string'
        ]);

        $stock->update($data);

        return redirect()->route('stocks.index')
            ->with('success', 'Stok berhasil diperbarui!');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return back()->with('success', 'Stok dihapus!');
    }

    // Tambah/Kurangi Stok
    public function adjust(Request $request, Stock $stock)
    {
        $data = $request->validate([
            'quantity_change' => 'required|numeric',
            'type' => 'required|in:purchase,usage,adjustment',
            'notes' => 'nullable|string'
        ]);

        $stock->increment('quantity', $data['quantity_change']);

        StockHistory::create([
            'stock_id' => $stock->id,
            'quantity_change' => $data['quantity_change'],
            'type' => $data['type'],
            'user_id' => auth()->id(),
            'notes' => $data['notes']
        ]);

        return back()->with('success', 'Stok berhasil disesuaikan!');
    }
}
