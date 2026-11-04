<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Saya - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:py-14">
    <nav class="flex flex-wrap items-center justify-between gap-4">
        <a class="text-xl font-extrabold tracking-tight text-violet-700" href="{{ route('freelancer.dashboard') }}">FreelanceHub</a>
        <div class="flex flex-wrap gap-4 text-sm font-semibold text-slate-600">
            <a class="hover:text-violet-700" href="{{ route('jasa.index') }}">Jasa Saya</a>
            <a class="text-violet-700" href="{{ route('portfolios.index') }}">Portofolio</a>
            <a class="hover:text-violet-700" href="{{ route('freelancer.dashboard') }}">Dashboard</a>
        </div>
    </nav>

    @if (session('success'))
        <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800" role="alert">{{ session('error') }}</div>
    @endif

    <header class="mt-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-violet-700">Profil freelancer</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Portofolio Saya</h1>
            <p class="mt-3 max-w-2xl text-slate-600">Tampilkan hasil karya terbaik untuk membantu klien memahami kualitas pekerjaanmu.</p>
        </div>
        <a class="inline-flex items-center justify-center rounded-xl bg-violet-700 px-5 py-3 font-semibold text-white hover:bg-violet-800"
           href="{{ route('portfolios.create') }}">+ Tambah karya</a>
    </header>

    <section class="mt-8 grid gap-4 sm:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Total karya</p>
            <p class="mt-1 text-3xl font-bold">{{ $portfolios->count() }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Karya terkait jasa</p>
            <p class="mt-1 text-3xl font-bold">{{ $portfolios->whereNotNull('service_id')->count() }}</p>
        </div>
    </section>

    <section class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($portfolios as $portfolio)
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                @if ($portfolio->imageUrl())
                    <img class="aspect-[16/10] w-full object-cover" src="{{ $portfolio->imageUrl() }}"
                         alt="{{ $portfolio->title ?? $portfolio->caption }}">
                @else
                    <div class="grid aspect-[16/10] place-items-center bg-gradient-to-br from-violet-100 to-indigo-50 text-3xl text-violet-700" aria-hidden="true">✦</div>
                @endif
                <div class="p-5">
                    <h2 class="text-lg font-bold">{{ $portfolio->title ?? $portfolio->caption }}</h2>
                    @if ($portfolio->description)
                        <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">{{ $portfolio->description }}</p>
                    @endif
                    @if ($portfolio->service)
                        <p class="mt-3 text-sm text-slate-500">Jasa terkait: {{ $portfolio->service->title }}</p>
                    @endif
                    @if ($portfolio->project_link)
                        <a class="mt-3 inline-block text-sm font-semibold text-violet-700 hover:underline"
                           href="{{ $portfolio->project_link }}" target="_blank" rel="noopener noreferrer">Lihat proyek ↗</a>
                    @endif
                    <div class="mt-5 flex items-center justify-between border-t border-slate-100 pt-4">
                        <a class="text-sm font-semibold text-violet-700 hover:underline"
                           href="{{ route('portfolios.edit', $portfolio) }}">Edit karya</a>
                        <form action="{{ route('portfolios.destroy', $portfolio) }}" method="POST"
                              onsubmit="return confirm('Hapus portofolio ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm font-semibold text-red-700 hover:underline" type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center sm:col-span-2 lg:col-span-3">
                <h2 class="text-lg font-bold">Portofolio masih kosong</h2>
                <p class="mt-2 text-slate-600">Tambahkan proyek pertamamu untuk mulai memamerkan hasil karya.</p>
                <a class="mt-5 inline-flex rounded-lg bg-violet-700 px-4 py-2.5 font-semibold text-white hover:bg-violet-800"
                   href="{{ route('portfolios.create') }}">Tambah karya pertama</a>
            </div>
        @endforelse
    </section>
</main>
</body>
</html>
