<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-gray-100 uppercase">Artists</h1>
                
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEmployee()))
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Create, edit, and manage artists.</p>
                @else
                    <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">View artists.</p>
                @endif
            </div>
            <div class="flex gap-2">
                @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isEmployee()))
                <a href="{{ route('artists.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">ADD ARTIST</a>
                @endif
            </div>
        </div>
    </x-slot>

<body class="bg-gray-50 text-gray-800">
    
    <div class="max-w-6xl mx-auto py-8 px-4 ">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(isset($artists) && $artists->count())
            <div class="overflow-hidden rounded-3xl bg-white shadow border border-slate-200">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biography</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($artists as $artist)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $artist->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $artist->country ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $artist->bio ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('artists.edit', $artist->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('artists.destroy', $artist->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this artist?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="p-8 text-center">
                <p class="text-gray-600 mb-4">There are no artists added yet.</p>
                <a href="{{ route('artists.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Add an artist</a>
            </div>
            @endif
        </div>
    </div>
</body>
</x-app-layout>