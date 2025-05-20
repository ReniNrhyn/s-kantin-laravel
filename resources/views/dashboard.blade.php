<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="font-bold text-center">Total User</h1>
                        <h3 class="text-center">{{ $users }}</h3>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="font-bold text-center">Total Menu</h1>
                        <h3 class="text-center">{{ $menus }}</h3>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="font-bold text-center">Total Transaksi</h1>
                        <h3 class="text-center">{{ $transactions }}</h3>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="font-bold text-center">Total Category</h1>
                        <h3 class="text-center">{{ $categories }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1>Dashboard Statistik</h1>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                                       {{-- {!! $chart->container() !!}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {!! $chartL->container() !!} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Users Card -->
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg transform transition-all hover:-translate-y-1 hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300 truncate">Total Users</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $userCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('users.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Card -->
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg transform transition-all hover:-translate-y-1 hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300 truncate">Total Menu</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $menuCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('menus.index') }}" class="text-sm text-green-600 dark:text-green-400 hover:underline">View all</a>
                        </div>
                    </div>
                </div>

                <!-- Transactions Card -->
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg transform transition-all hover:-translate-y-1 hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300 truncate">Total Transactions</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $transactionCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('transactions.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View all</a>
                        </div>
                    </div>
                </div>

                <!-- Categories Card -->
                <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg transform transition-all hover:-translate-y-1 hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-300 truncate">Total Categories</p>
                                <p class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $categoryCount }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('categories.index') }}" class="text-sm text-yellow-600 dark:text-yellow-400 hover:underline">View all</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity Section -->
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="p-2 rounded-full bg-{{ $activity->color }}-100 dark:bg-{{ $activity->color }}-900 text-{{ $activity->color }}-600 dark:text-{{ $activity->color }}-300">
                                    @if($activity->type === 'user')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    @elseif($activity->type === 'transaction')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $activity->description }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $activity->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($recentActivities->count() > 0)
                    <div class="mt-4">
                        <a href="{{ route('activities.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">View all activities</a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('users.create') }}" class="p-4 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded-lg text-center transition-colors">
                            <div class="mx-auto p-2 w-12 h-12 bg-blue-100 dark:bg-blue-800 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-300 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Add User</span>
                        </a>

                        <a href="{{ route('menus.create') }}" class="p-4 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 rounded-lg text-center transition-colors">
                            <div class="mx-auto p-2 w-12 h-12 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center text-green-600 dark:text-green-300 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Add Menu</span>
                        </a>

                        <a href="{{ route('transactions.create') }}" class="p-4 bg-indigo-50 dark:bg-indigo-900/30 hover:bg-indigo-100 dark:hover:bg-indigo-900/50 rounded-lg text-center transition-colors">
                            <div class="mx-auto p-2 w-12 h-12 bg-indigo-100 dark:bg-indigo-800 rounded-full flex items-center justify-center text-indigo-600 dark:text-indigo-300 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">New Transaction</span>
                        </a>

                        <a href="{{ route('categories.create') }}" class="p-4 bg-yellow-50 dark:bg-yellow-900/30 hover:bg-yellow-100 dark:hover:bg-yellow-900/50 rounded-lg text-center transition-colors">
                            <div class="mx-auto p-2 w-12 h-12 bg-yellow-100 dark:bg-yellow-800 rounded-full flex items-center justify-center text-yellow-600 dark:text-yellow-300 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-200">Add Category</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
