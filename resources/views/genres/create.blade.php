<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-gray-100">Create a new genre</h1>
            </div>
            <div class="flex gap-2">
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEmployee()))
                <a href="{{ route('genres.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">ADD GENRE</a>
                @endif
            </div>
        </div>
    </x-slot>





    <body class="bg-gray-50 text-gray-800">

        <div class="max-w-3xl mx-auto py-8 px-4">

            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('genres.store') }}" method="post" class="space-y-4">
                    
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Genre Name</label>
                        <input type="text" name="name" id="name" required class="mt-1 block w-full border rounded px-3 py-2">
                    </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" class="mt-1 block w-full border rounded px-3 py-2" rows="4"></textarea>
                        </div>
                    </div>


                    <div class="pt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Add Genre</button>
                        <a href="{{ route('genres.index') }}" class="ml-3 text-sm text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </body>
</x-app-layout>