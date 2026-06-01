<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 leading-tight uppercase">
            {{ strtoupper(Auth::user()->role) }} DASHBOARD
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg bg-white dark:bg-slate-900 shadow">
                <div class="p-6 text-slate-700 dark:text-slate-100">
                    <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ strtoupper(Auth::user()->role) }} DASHBOARD</p>
                    <p class="mt-4">Welcome to your dashboard. Use the navigation above to manage your commissions, applications, and account tools.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
