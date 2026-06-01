<nav class="bg-white shadow-sm">
    <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-lg font-semibold text-gray-800">Muziekwinkel</a>
            <a href="{{ route('welcome') }}" class="text-sm text-gray-600 hover:text-gray-900">Home</a>
            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900">Dashboard</a>
            <a href="{{ route('albums.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Albums</a>
            <a href="{{ route('tracks.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Nummers</a>
            <a href="{{ route('genres.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Genres</a>
            <a href="{{ route('artists.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Artiesten</a>
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Bestellingen</a>
        </div>

        <div class="flex items-center gap-3">
            @guest
                <a href="{{ url('/login') }}" class="text-sm text-gray-600 hover:text-gray-900">Inloggen</a>
                <a href="{{ url('/register') }}" class="text-sm text-gray-600 hover:text-gray-900">Registreren</a>
            @else
                <span class="text-sm text-gray-700">{{ Auth::user()->name ?? Auth::user()->email }}</span>
                <form method="POST" action="{{ url('/logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">Uitloggen</button>
                </form>
            @endguest
        </div>
    </div>
</nav>
