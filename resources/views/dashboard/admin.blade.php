<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-lg bg-white dark:bg-slate-900 shadow">
                <div class="p-6 text-slate-700 dark:text-slate-100">
                    Welcome to the admin dashboard. Use the navigation to access management sections.
                </div>
            </div>
        </div>
    </div>
</x-app-layout>