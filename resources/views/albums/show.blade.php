<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $album->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-900 overflow-hidden rounded-lg shadow p-6">
                <p class="text-sm text-slate-500">{{ $album->artist->name ?? 'Unknown artist' }} • {{ $album->genre->name ?? 'No genre' }}</p>

                @if($album->image_url)
                <div class="mt-4 overflow-hidden rounded-xl border bg-slate-50">
                    <img src="{{ $album->image_url }}" alt="{{ $album->title }}" class="w-full h-72 object-cover" />
                </div>
                @endif

                <h1 class="mt-6 text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $album->title }}</h1>

                <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <div class="text-xs text-slate-500">Price</div>
                        <div class="font-medium">€{{ number_format($album->price, 2) }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500">Stock</div>
                        <div class="font-medium">{{ $album->stock }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-slate-500">Released</div>
                        <div class="font-medium">{{ optional($album->release_year)->format('d-m-Y') ?? 'N/A' }}</div>
                        @method('delete')
                        <button type="submit" class="px-3 py-2 rounded bg-red-600 text-white text-sm">Delete</button>
                        </form>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>