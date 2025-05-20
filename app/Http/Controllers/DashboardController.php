<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\Category;

// use App\Models\ActivityLog;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::count();
        $menus = Menu::count();
        $transactions = Transaction::count();
        $categories = Category::count();

        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $data = [65, 59, 80, 81, 56, 55];

        // $recentActivities = ActivityLog::with('user')
        //     ->latest()
        //     ->take(5)
        //     ->get()
        //     ->map(function ($activity) {
        //         // Tambahkan warna berdasarkan jenis aktivitas
        //         $activity->color = match($activity->type) {
        //             'user' => 'blue',
        //             'menu' => 'green',
        //             'transaction' => 'indigo',
        //             default => 'gray'
        //         };
        //         return $activity;
        //     });

        return view('dashboard', compact(
            'users',
            'menus',
            'transactions',
            'categories',
            // 'recentActivities'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
