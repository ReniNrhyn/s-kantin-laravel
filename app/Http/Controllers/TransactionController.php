<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::with(['user', 'menu'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhereHas('menu', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })
                ->orWhere('payment_method', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $menus = Menu::all();
        return view('transactions.create', compact('users', 'menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,e-wallet,credit_card,debit_card',
        ]);

        try {
            DB::beginTransaction();

            $menu = Menu::findOrFail($request->menu_id);
            $totalPrice = $menu->price * $request->quantity;

            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
            ]);

            DB::commit();

            return redirect()->route('transactions.index')
                ->with('success', 'Transaction created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create transaction: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $users = User::all();
        $menus = Menu::all();
        return view('transactions.edit', compact('transaction', 'users', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,e-wallet,credit_card,debit_card',
        ]);

        try {
            DB::beginTransaction();

            $menu = Menu::findOrFail($request->menu_id);
            $totalPrice = $menu->price * $request->quantity;

            $transaction->update([
                'user_id' => $request->user_id,
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity,
                'total_price' => $totalPrice,
                'payment_method' => $request->payment_method,
            ]);

            DB::commit();

            return redirect()->route('transactions.index')
                ->with('success', 'Transaction updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update transaction: ' . $e->getMessage());
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
                ->with('success', 'Transaction deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete transaction: ' . $e->getMessage());
        }
    }
}
