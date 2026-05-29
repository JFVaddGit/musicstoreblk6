<x-app-layout>
    <div class="min-h-screen bg-white dark:bg-slate-900">
        <div class="mx-auto max-w-7xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl bg-white dark:bg-slate-900 shadow-xl ring-1 ring-black/5 dark:ring-white/10">
                <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:gap-0">
                    <div class="p-10 sm:p-16 lg:p-20">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-indigo-600">Welkom bij Muziekwinkel</p>
                        <h1 class="mt-6 text-4xl font-semibold tracking-tight text-slate-900 dark:text-slate-100 sm:text-5xl">De muziekwinkel voor jouw favoriete albums.</h1>
                        <p class="mt-6 max-w-2xl text-base leading-8 text-slate-600 dark:text-slate-300">Ontdek nieuwe albums, blader door genres en artiesten, en log in om je collectie te beheren.</p>

                        <div class="mt-10 flex flex-col gap-3 sm:flex-row sm:items-center">
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Inloggen</a>
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full bg-slate-100 px-6 py-3 text-sm font-semibold text-slate-900 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">Registreren</a>
                            @endif
                        </div>
                    </div>

                    <div class="relative overflow-hidden bg-slate-900 text-white p-10 sm:p-16 lg:p-20">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-violet-500 to-sky-500 opacity-20"></div>
                        <div class="relative">
                            <div class="text-base font-semibold uppercase tracking-[0.24em] text-white/80">Spelen met muziek</div>
                            <h2 class="mt-6 text-3xl font-semibold tracking-tight text-white sm:text-4xl">Blader, koop en beheer.</h2>
                            <p class="mt-6 text-base leading-8 text-white/80">Een gastvriendelijke startpagina die dezelfde app-layout en navigatie gebruikt als de rest van je site.</p>
                            <div class="mt-10 grid gap-3 text-sm text-white/90 sm:grid-cols-2">
                                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">Snelle toegang tot albums</div>
                                <div class="rounded-3xl border border-white/10 bg-white/5 p-5 backdrop-blur">Consistente look met dashboard</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>