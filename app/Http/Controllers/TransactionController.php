<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::when(request()->search, function ($query) {
            return $query->where('invoice_number', 'like', '%' . request()->search . '%');
        })->paginate(10);

        return view('transactions.index', compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'invoice_number' => 'required|string|unique:transactions',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'transaction_date' => 'required|date',
            'status' => 'required|in:completed,pending,canceled'
        ]);

        try {
            $transaction = Transaction::create($request->all());
            return redirect()->route('transactions.index')
                ->with('success', 'Transaction #' . $transaction->invoice_number . ' has been added successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'invoice_number' => 'required|string|unique:transactions,invoice_number,' . $transaction->id,
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'transaction_date' => 'required|date',
            'status' => 'required|in:completed,pending,canceled'
        ]);

        try {
            $transaction->update($request->all());
            return redirect()->route('transactions.index')
                ->with('success', 'Transaction #' . $transaction->invoice_number . ' has been updated successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
            return redirect()->route('transactions.index')
                ->with('success', 'Transaction #' . $transaction->invoice_number . ' has been deleted successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
