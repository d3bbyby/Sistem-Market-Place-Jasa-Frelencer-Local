<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#12514c">
    <title>Jasa Saya - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F2FAF9] text-[#183B3A] antialiased">
<header class="sticky top-0 z-20 border-b border-[#D8EAE7] bg-white/95 shadow-sm backdrop-blur">
    <nav class="mx-auto flex max-w-6xl flex-col gap-3 px-4 py-3 sm:flex-row sm:items-center sm:justify-between sm:px-6"
         aria-label="Navigasi freelancer">
        <a class="flex shrink-0 items-center gap-2 text-lg font-extrabold tracking-tight text-[#183B3A]"
           href="{{ route('freelancer.dashboard') }}">
            <span class="grid size-9 place-items-center rounded-xl bg-[#0E756D] text-sm text-white" aria-hidden="true">F</span>
            FreelanceHub
        </a>
        <div class="flex max-w-full items-center gap-1 overflow-x-auto pb-1 sm:pb-0">
            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('jasa.index') }}" aria-current="page">Jasa Saya</a>
            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('portfolios.index') }}">Portofolio</a>
            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('categories.index') }}">Kategori</a>
            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('freelancer.dashboard') }}">Dashboard</a>
        </div>
    </nav>
</header>

@php
    $hasFilters = collect($filters)->contains(fn ($value) => $value !== null && $value !== '');
@endphp

<main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:py-12">
    @if (session('success'))
        <div class="mb-6 rounded-xl border border-[#B8DFD9] bg-[#E0F5F1] p-4 text-sm text-[#12514C]" role="status">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <header class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#0E756D]">Workspace Freelancer</p>
            <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#183B3A] sm:text-4xl">Jasa Saya</h1>
            <p class="mt-3 max-w-2xl leading-6 text-[#72918D]">
                Atur layanan yang kamu tawarkan dan pantau pesanan yang masuk.
            </p>
        </div>
        <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0E756D] px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D]"
           href="{{ route('jasa.create') }}"><span aria-hidden="true">+</span> Tambah Jasa</a>
    </header>

    <section class="mt-8 grid gap-4 sm:grid-cols-3" aria-label="Ringkasan jasa">
        <article class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Jasa ditemukan</p>
            <p class="mt-2 text-3xl font-extrabold text-[#183B3A]">{{ $jasa->count() }}</p>
        </article>
        <article class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Kategori digunakan</p>
            <p class="mt-2 text-3xl font-extrabold text-[#183B3A]">{{ $jasa->pluck('category_id')->unique()->count() }}</p>
        </article>
        <article class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Pesanan pada jasa</p>
            <p class="mt-2 text-3xl font-extrabold text-[#183B3A]">{{ $jasa->sum('orders_count') }}</p>
        </article>
    </section>

    <section class="mt-7 rounded-2xl border border-[#D8EAE7] bg-white p-4 shadow-sm sm:p-5"
             aria-labelledby="filters-heading">
        <div class="mb-3">
            <h2 class="text-sm font-bold text-[#183B3A]" id="filters-heading">Cari dan filter jasa</h2>
            <p class="mt-1 text-xs text-[#72918D]">Persempit daftar berdasarkan kata kunci atau kategori.</p>
        </div>
        <form class="grid gap-3 sm:grid-cols-2 lg:grid-cols-5" method="GET" action="{{ route('jasa.index') }}">
            <input class="min-w-0 rounded-xl border border-[#C7DCD8] px-3 py-2.5 text-sm text-[#183B3A] outline-none placeholder:text-[#91A8A4] focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15 lg:col-span-2"
                   type="search" name="q" value="{{ $filters['q'] ?? '' }}"
                   placeholder="Cari judul atau deskripsi jasa" aria-label="Cari judul atau deskripsi jasa">
            <select class="min-w-0 rounded-xl border border-[#C7DCD8] bg-white px-3 py-2.5 text-sm text-[#183B3A] outline-none focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                    name="category_id" aria-label="Filter kategori">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            <button class="inline-flex items-center justify-center rounded-xl bg-[#0E756D] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D]"
                    type="submit">Cari &amp; Filter</button>
            <a class="inline-flex items-center justify-center rounded-xl border border-[#C7DCD8] bg-white px-4 py-2.5 text-sm font-semibold text-[#315B57] transition hover:bg-[#F2FAF9]"
               href="{{ route('jasa.index') }}">Reset</a>
        </form>
    </section>

    <div class="mt-7 flex flex-wrap items-center justify-between gap-2 text-sm">
        <p class="text-[#72918D]"><span class="font-bold text-[#183B3A]">{{ $jasa->count() }}</span> layanan ditemukan</p>
        @if ($hasFilters)
            <span class="rounded-full bg-[#E0F5F1] px-3 py-1 text-xs font-semibold text-[#12514C]">Filter sedang diterapkan</span>
        @endif
    </div>

    <section class="mt-4 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" aria-label="Daftar jasa">
        @forelse ($jasa as $item)
            <article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-[#D8EAE7] bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:border-[#B8DFD9] hover:shadow-lg">
                @if ($item->mainImageUrl())
                    <img class="aspect-[16/9] w-full bg-[#E0F5F1] object-cover transition duration-300 group-hover:scale-[1.02]"
                         src="{{ $item->mainImageUrl() }}" alt="Foto jasa {{ $item->title }}" loading="lazy">
                @else
                    <div class="grid aspect-[16/9] place-items-center bg-gradient-to-br from-[#E0F5F1] to-[#F2FAF9]">
                        <span class="grid size-12 place-items-center rounded-2xl bg-white/80 font-extrabold text-[#0E756D] shadow-sm" aria-hidden="true">J</span>
                    </div>
                @endif
                <div class="flex flex-1 flex-col p-5">
                    <div class="flex items-start justify-between gap-3">
                        <span class="inline-flex max-w-[75%] rounded-full border border-[#CDE8E3] bg-[#E0F5F1] px-3 py-1 text-xs font-semibold text-[#12514C]">
                            {{ $item->category?->category_name ?? 'Tanpa kategori' }}
                        </span>
                        <span class="shrink-0 text-xs text-[#72918D]">{{ $item->orders_count }} pesanan</span>
                    </div>
                    <h2 class="mt-4 text-lg font-bold leading-snug text-[#183B3A]">{{ $item->title }}</h2>
                    <p class="mt-2 line-clamp-3 min-h-[3.75rem] text-sm leading-5 text-[#72918D]">
                        {{ Str::limit($item->description, 150) }}
                    </p>
                    <p class="mt-3 text-xs text-[#72918D]">
                        Ditawarkan oleh <span class="font-semibold text-[#315B57]">{{ auth()->user()->name ?? 'Freelancer' }}</span>
                    </p>
                    <div class="mt-auto flex items-end justify-between gap-3 border-t border-[#E8F2F0] pt-4">
                        <div>
                            <p class="text-xs text-[#72918D]">Harga mulai dari</p>
                            <p class="mt-1 text-lg font-extrabold text-[#0E756D]">
                                Rp{{ number_format((float) $item->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between border-t border-[#E8F2F0] pt-4">
                        <a class="text-sm font-semibold text-[#0E756D] hover:text-[#12514C] hover:underline"
                           href="{{ route('jasa.edit', $item) }}">Edit jasa</a>
                        <form action="{{ route('jasa.destroy', $item) }}" method="POST"
                              onsubmit="return confirm('Hapus jasa ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm font-semibold text-red-700 hover:text-red-900 hover:underline"
                                    type="submit">Hapus jasa</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="rounded-2xl border border-dashed border-[#B8DFD9] bg-white px-6 py-12 text-center sm:col-span-2 lg:col-span-3">
                <span class="mx-auto grid size-14 place-items-center rounded-2xl bg-[#E0F5F1] text-2xl font-bold text-[#0E756D]" aria-hidden="true">+</span>
                <h2 class="mt-4 text-lg font-bold text-[#183B3A]">
                    {{ $hasFilters ? 'Jasa tidak ditemukan' : 'Belum ada jasa' }}
                </h2>
                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#72918D]">
                    {{ $hasFilters
                        ? 'Coba ubah kata kunci atau filter untuk melihat hasil lainnya.'
                        : 'Buat layanan pertamamu agar klien dapat menemukan dan memesan jasamu.' }}
                </p>
                @if ($hasFilters)
                    <a class="mt-5 inline-flex rounded-xl border border-[#C7DCD8] px-4 py-2.5 text-sm font-semibold text-[#315B57] transition hover:bg-[#F2FAF9]"
                       href="{{ route('jasa.index') }}">Hapus filter</a>
                @else
                    <a class="mt-5 inline-flex rounded-xl bg-[#0E756D] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#12514C]"
                       href="{{ route('jasa.create') }}">Buat Jasa Pertama</a>
                @endif
            </div>
        @endforelse
    </section>
</main>
</body>
</html>
