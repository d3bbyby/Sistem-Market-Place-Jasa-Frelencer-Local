<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasa {{ $category->category_name }} - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:py-14">
    <a class="text-sm font-semibold text-violet-700 hover:text-violet-900" href="{{ url('/') }}">← Beranda</a>
    <header class="mt-7">
        <p class="text-sm font-semibold uppercase tracking-wide text-violet-700">Kategori jasa</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">{{ $category->category_name }}</h1>
        <p class="mt-3 text-slate-600">Temukan freelancer dan layanan yang sesuai dengan kebutuhanmu.</p>
    </header>

    <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($services as $service)
            <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                @if ($service->mainImageUrl())
                    <img class="aspect-[16/10] w-full object-cover" src="{{ $service->mainImageUrl() }}" alt="Foto {{ $service->title }}">
                @else
                    <div class="grid aspect-[16/10] place-items-center bg-gradient-to-br from-violet-100 to-indigo-50 text-3xl text-violet-700" aria-hidden="true">✦</div>
                @endif
                <div class="p-5">
                    <h2 class="text-lg font-bold">{{ $service->title }}</h2>
                    <p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">{{ $service->description }}</p>
                    <div class="mt-5 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs text-slate-500">Mulai dari</p>
                            <p class="font-bold text-violet-800">Rp{{ number_format((float) $service->price, 0, ',', '.') }}</p>
                        </div>
                        <a class="rounded-lg bg-violet-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-violet-800"
                           href="{{ route('jasa.show', $service) }}">Lihat detail</a>
                    </div>
                    <p class="mt-4 border-t border-slate-100 pt-4 text-sm text-slate-500">
                        Oleh <span class="font-semibold text-slate-700">{{ $service->freelancer?->name ?? 'Freelancer' }}</span>
                    </p>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center sm:col-span-2 lg:col-span-3">
                <h2 class="text-lg font-bold">Belum ada jasa pada kategori ini</h2>
                <p class="mt-2 text-slate-600">Silakan kembali lagi nanti untuk melihat layanan baru.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">{{ $services->links() }}</div>
</main>
</body>
</html>
