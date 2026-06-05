<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 leading-tight uppercase">
                    ADMIN DASHBOARD
                </h2>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Quick links to all admin indexes and tools.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid gap-6 xl:grid-cols-3">
                <a href="{{ route('albums.index') }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
                    <div class="p-6">
                        <p class="text-sm uppercase tracking-wide text-indigo-600 font-semibold">Albums</p>
                        <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-slate-100">Manage Albums</h3>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">View, edit, and organize album records across the catalog.</p>
                        <div class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-indigo-600 group-hover:text-indigo-700">
                            <span>Go to Albums</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('tracks.index') }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
                    <div class="p-6">
                        <p class="text-sm uppercase tracking-wide text-emerald-600 font-semibold">Tracks</p>
                        <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-slate-100">Manage Tracks</h3>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Browse and update individual tracks attached to albums.</p>
                        <div class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-emerald-600 group-hover:text-emerald-700">
                            <span>Go to Tracks</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('artists.index') }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
                    <div class="p-6">
                        <p class="text-sm uppercase tracking-wide text-pink-600 font-semibold">Artists</p>
                        <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-slate-100">Manage Artists</h3>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Edit artist details and keep your catalog linked correctly.</p>
                        <div class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-pink-600 group-hover:text-pink-700">
                            <span>Go to Artists</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('genres.index') }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
                    <div class="p-6">
                        <p class="text-sm uppercase tracking-wide text-violet-600 font-semibold">Genres</p>
                        <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-slate-100">Manage Genres</h3>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Create and update genre categories for the store.</p>
                        <div class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-violet-600 group-hover:text-violet-700">
                            <span>Go to Genres</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('orders.index') }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-md transition">
                    <div class="p-6">
                        <p class="text-sm uppercase tracking-wide text-amber-600 font-semibold">Orders</p>
                        <h3 class="mt-3 text-2xl font-semibold text-slate-900 dark:text-slate-100">Manage Orders</h3>
                        <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">Review recent orders and manage the order pipeline.</p>
                        <div class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-amber-600 group-hover:text-amber-700">
                            <span>Go to Orders</span>
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>