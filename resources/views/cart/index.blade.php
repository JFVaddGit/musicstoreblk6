<x-app-layout>


    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h1 class="font-bold text-xl text-gray-800 dark:text-gray-100 uppercase">Shopping Cart</h1>
                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Review the items in your cart before proceeding to checkout.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('albums.index') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">CONTINUE SHOPPING</a>
            </div>
        </div>
    </x-slot>

    <body class="bg-gray-50 text-gray-800">
        <div class="py-12">
            <div class="max-w-4xl mx-auto">

                @foreach($cartItems as $item)
                    <div class="bg-white rounded-lg shadow p-4 mb-4">

                        <div class="flex justify-between items-center">

                            <div>
                                <h2 class="font-semibold">
                                    {{ $item->album->title }}
                                </h2>

                                <p>
                                    €{{ $item->album->price }}
                                </p>

                                <p>
                                    Quantity: {{ $item->quantity }}
                                </p>
                            </div>

                            <form
                                action="{{ route('cart.destroy', $item) }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')

                                <button class="text-red-600">
                                    Remove
                                </button>
                            </form>

                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </body>
</x-app-layout>