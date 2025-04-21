<?php

namespace App\Http\Controllers;

// use App\Models\Transaction;
// use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $transactions = Transaction::when(request()->search, function ($query) {
    //         return $query->where('invoice_number', 'like', '%' . request()->search . '%');
    //     })->paginate(10);

    //     return view('transactions.index', compact('transactions'))
    //         ->with('i', (request()->input('page', 1) - 1) * 10);
    // }
    public function index(Request $request)
    {
        $query = Transaction::query()
            ->with(['user', 'menu'])
            ->latest();

        // Filter berdasarkan tanggal
        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        // Filter berdasarkan invoice number
        if ($request->search) {
            $query->where('invoice_number', 'like', '%'.$request->search.'%');
        }

        $transactions = $query->paginate(10);

        return view('transactions.index', compact('transactions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('transactions.create');
    // }
    public function create()
    {
        $menus = Menu::all();
        $cashiers = User::where('role', 'cashier')->get();
        return view('transactions.create', compact('menus', 'cashiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'menu_id' => 'required|exists:menus,id',
    //         'invoice_number' => 'required|string|unique:transactions',
    //         'quantity' => 'required|integer|min:1',
    //         'total_price' => 'required|numeric|min:0',
    //         'payment_method' => 'required|string',
    //         'transaction_date' => 'required|date',
    //         'status' => 'required|in:completed,pending,canceled'
    //     ]);

    //     try {
    //         $transaction = Transaction::create($request->all());
    //         return redirect()->route('transactions.index')
    //             ->with('success', 'Transaction #' . $transaction->invoice_number . ' has been added successfully!');
    //     } catch (\Throwable $th) {
    //         return back()->with('error', $th->getMessage());
    //     }
    // }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,e-wallet,bank_transfer',
        ]);

        // Generate invoice number
        $validated['invoice_number'] = 'INV-'.date('Ymd').'-'.str_pad(Transaction::count() + 1, 4, '0', STR_PAD_LEFT);
        $validated['status'] = 'completed';

        Transaction::create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dicatat!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     return view('transactions.show', compact('transaction'));
    // }
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        // return view('transactions.edit', compact('transaction'));
        $menus = Menu::all();
        $cashiers = User::where('role', 'cashier')->get();
        return view('transactions.edit', compact('transaction', 'menus', 'cashiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id',
        //     'menu_id' => 'required|exists:menus,id',
        //     'invoice_number' => 'required|string|unique:transactions,invoice_number,' . $transaction->id,
        //     'quantity' => 'required|integer|min:1',
        //     'total_price' => 'required|numeric|min:0',
        //     'payment_method' => 'required|string',
        //     'transaction_date' => 'required|date',
        //     'status' => 'required|in:completed,pending,canceled'
        // ]);

        // try {
        //     $transaction->update($request->all());
        //     return redirect()->route('transactions.index')
        //         ->with('success', 'Transaction #' . $transaction->invoice_number . ' has been updated successfully!');
        // } catch (\Throwable $th) {
        //     return back()->with('error', $th->getMessage());
        // }
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,e-wallet,bank_transfer',
            'status' => 'required|in:completed,pending,canceled',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        // try {
        //     $transaction->delete();
        //     return redirect()->route('transactions.index')
        //         ->with('success', 'Transaction #' . $transaction->invoice_number . ' has been deleted successfully!');
        // } catch (\Throwable $th) {
        //     return back()->with('error', $th->getMessage());
        // }
        $transaction->delete();
        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function print(Transaction $transaction)
    {
        return view('transactions.print', compact('transaction'));
    }
}
