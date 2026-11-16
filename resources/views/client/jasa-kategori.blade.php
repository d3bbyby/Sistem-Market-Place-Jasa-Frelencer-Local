<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f8fafc">
    <title>{{ $category->category_name }} - Jasa FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<nav class="border-b border-slate-200/80 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
        <a class="flex items-center gap-2 text-lg font-extrabold tracking-tight text-slate-900" href="{{ url('/') }}">
            <span class="grid size-9 place-items-center rounded-xl bg-violet-700 text-sm text-white">F</span>
            FreelanceHub
        </a>
        <div class="flex items-center gap-3">
            <a class="hidden text-sm font-semibold text-slate-600 hover:text-violet-700 sm:inline"
               href="{{ route('client.jasa') }}">Semua jasa</a>
            @auth
                @if (auth()->user()->role === 'admin')
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-violet-200 hover:text-violet-700"
                       href="{{ route('admin.dashboard') }}">Dashboard</a>
                @elseif (auth()->user()->role === 'freelancer')
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-violet-200 hover:text-violet-700"
                       href="{{ route('freelancer.dashboard') }}">Dashboard</a>
                @else
                    <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-violet-200 hover:text-violet-700"
                       href="{{ route('client.dashboard') }}">Dashboard</a>
                @endif
            @else
                <a class="rounded-lg bg-violet-700 px-3 py-2 text-sm font-semibold text-white hover:bg-violet-800"
                   href="{{ route('login') }}">Masuk</a>
            @endauth
        </div>
    </div>
</nav>

<main class="mx-auto max-w-5xl px-4 py-8 sm:px-6 sm:py-11">
    <nav class="flex flex-wrap items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb">
        <a class="font-medium hover:text-violet-700" href="{{ url('/') }}">Beranda</a>
        <span aria-hidden="true">/</span>
        @if ($category->parent)
            <a class="font-medium hover:text-violet-700"
               href="{{ route('categories.services', ['category' => $category->parent->slug]) }}">
                {{ $category->parent->category_name }}
            </a>
            <span aria-hidden="true">/</span>
        @else
            <span>Kategori jasa</span>
            <span aria-hidden="true">/</span>
        @endif
        <span class="font-semibold text-slate-800" aria-current="page">{{ $category->category_name }}</span>
    </nav>

    <header class="mt-6 overflow-hidden rounded-3xl border border-violet-100 bg-gradient-to-br from-white via-white to-violet-50 p-6 shadow-sm sm:p-9">
        <div class="flex flex-col justify-between gap-6 sm:flex-row sm:items-end">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full bg-violet-100 px-3 py-1.5 text-xs font-bold uppercase tracking-wide text-violet-800">
                    <span class="size-1.5 rounded-full bg-violet-600" aria-hidden="true"></span>
                    Kategori jasa
                </span>
                <h1 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">
                    {{ $category->category_name }}
                </h1>
                <p class="mt-3 text-base leading-7 text-slate-600">
                    Temukan freelancer dan layanan yang sesuai dengan kebutuhanmu.
                </p>
                @if ($category->parent)
                    <p class="mt-3 text-sm text-slate-500">
                        Bagian dari
                        <a class="font-semibold text-violet-700 hover:underline"
                           href="{{ route('categories.services', ['category' => $category->parent->slug]) }}">
                            {{ $category->parent->category_name }}
                        </a>
                    </p>
                @endif
            </div>
            <div class="flex min-w-36 items-center gap-3 rounded-2xl border border-slate-200 bg-white/90 px-4 py-3 shadow-sm">
                <span class="grid size-10 place-items-center rounded-xl bg-violet-50 text-lg text-violet-700" aria-hidden="true">▤</span>
                <div>
                    <p class="text-xl font-extrabold text-slate-900">{{ $services->total() }}</p>
                    <p class="text-xs font-medium text-slate-500">Jasa ditemukan</p>
                </div>
            </div>
        </div>
    </header>

    @if ($category->children->isNotEmpty())
        <section class="mt-9" aria-labelledby="subcategories-heading">
            <div class="flex flex-wrap items-end justify-between gap-3">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-violet-700">Jelajahi lebih spesifik</p>
                    <h2 id="subcategories-heading" class="mt-1 text-xl font-bold tracking-tight text-slate-900">Subkategori</h2>
                </div>
                <span class="text-sm text-slate-500">{{ $category->children->count() }} pilihan</span>
            </div>
            <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($category->children as $child)
                    <a class="group flex items-center justify-between gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:border-violet-200 hover:shadow-md"
                       href="{{ route('categories.services', ['category' => $child->slug]) }}">
                        <span class="min-w-0">
                            <span class="block truncate font-semibold text-slate-800 group-hover:text-violet-700">{{ $child->category_name }}</span>
                            <span class="mt-1 block text-xs text-slate-500">{{ $child->services_count }} jasa tersedia</span>
                        </span>
                        <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-violet-50 font-semibold text-violet-700 transition group-hover:bg-violet-700 group-hover:text-white" aria-hidden="true">→</span>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <section class="mt-10" aria-labelledby="services-heading">
        <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-violet-700">Pilihan freelancer</p>
                <h2 id="services-heading" class="mt-1 text-xl font-bold tracking-tight text-slate-900">Jasa dalam kategori ini</h2>
            </div>
            <p class="text-sm text-slate-500">
                Menampilkan {{ $services->firstItem() ?? 0 }}–{{ $services->lastItem() ?? 0 }} dari {{ $services->total() }} jasa
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            @forelse ($services as $service)
                <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:border-violet-200 hover:shadow-lg">
                    <a class="block overflow-hidden bg-slate-100" href="{{ route('jasa.show', $service) }}" aria-label="Lihat {{ $service->title }}">
                        @if ($service->mainImageUrl())
                            <img class="aspect-[16/9] w-full object-cover transition duration-300 group-hover:scale-[1.02]"
                                 src="{{ $service->mainImageUrl() }}" alt="Foto jasa {{ $service->title }}" loading="lazy">
                        @else
                            <div class="grid aspect-[16/9] place-items-center bg-gradient-to-br from-violet-100 via-indigo-50 to-fuchsia-100">
                                <span class="grid size-14 place-items-center rounded-2xl bg-white/80 text-2xl text-violet-700 shadow-sm" aria-hidden="true">✦</span>
                            </div>
                        @endif
                    </a>
                    <div class="flex flex-1 flex-col p-5 sm:p-6">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            @if ($service->category)
                                <a class="rounded-full bg-violet-50 px-3 py-1 text-xs font-semibold text-violet-800 hover:bg-violet-100"
                                   href="{{ route('categories.services', ['category' => $service->category->slug]) }}">
                                    {{ $service->category->category_name }}
                                </a>
                            @endif
                            <span class="text-xs font-medium text-slate-400">Jasa freelance</span>
                        </div>

                        <h3 class="mt-4 text-lg font-bold leading-snug text-slate-900">
                            <a class="hover:text-violet-700" href="{{ route('jasa.show', $service) }}">{{ $service->title }}</a>
                        </h3>
                        <p class="mt-2 line-clamp-2 min-h-12 text-sm leading-6 text-slate-600">
                            {{ $service->description }}
                        </p>

                        <div class="mt-auto pt-5">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <p class="text-xs font-medium text-slate-500">Mulai dari</p>
                                    <p class="mt-0.5 text-lg font-extrabold text-violet-800">
                                        Rp{{ number_format((float) $service->price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-700 px-4 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-violet-800 focus:outline-2 focus:outline-offset-2 focus:outline-violet-700"
                                   href="{{ route('jasa.show', $service) }}">
                                    Lihat detail <span aria-hidden="true">→</span>
                                </a>
                            </div>
                            <div class="mt-5 flex items-center gap-3 border-t border-slate-100 pt-4">
                                <span class="grid size-9 shrink-0 place-items-center rounded-full bg-slate-100 text-sm font-bold text-slate-600">
                                    {{ mb_strtoupper(mb_substr($service->freelancer?->name ?? 'F', 0, 1)) }}
                                </span>
                                <div class="min-w-0">
                                    <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">Ditawarkan oleh</p>
                                    <p class="truncate text-sm font-semibold text-slate-700">{{ $service->freelancer?->name ?? 'Freelancer' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-14 text-center md:col-span-2">
                    <span class="mx-auto grid size-14 place-items-center rounded-2xl bg-violet-50 text-2xl text-violet-700" aria-hidden="true">⌕</span>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">Belum ada jasa pada kategori ini</h3>
                    <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-600">
                        Coba jelajahi subkategori lain atau lihat semua jasa yang tersedia.
                    </p>
                    <a class="mt-5 inline-flex items-center justify-center rounded-xl bg-violet-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-violet-800"
                       href="{{ route('client.jasa') }}">Jelajahi semua jasa</a>
                </div>
            @endforelse
        </div>

        @if ($services->hasPages())
            <div class="mt-8">{{ $services->links() }}</div>
        @endif
    </section>
</main>
</body>
</html>
