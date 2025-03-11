<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Menu;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::when(request()->search, function ($transactions) {
            $transactions = $transactions->where('quantity', 'like', '%' . request()->search . '%');
        })->paginate(10);
        return view('transactions.index', compact('transactions'))
        ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::all();
        return view('transactions.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
    ]);

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $total_price = $menu->price * $request->quantity;

        Transaction::create([
            'user_id' => Auth::id(),
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $menus = Menu::all();
        return view('transactions.edit', compact('transaction', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $total_price = $menu->price * $request->quantity;

        $transaction->update([
            'menu_id' => $request->menu_id,
            'quantity' => $request->quantity,
            'total_price' => $total_price,
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( )
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
