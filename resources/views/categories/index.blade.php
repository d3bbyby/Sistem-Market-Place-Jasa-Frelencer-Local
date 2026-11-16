@php
    $isFreelancer = auth()->user()->role === 'freelancer';
    $accentText = $isFreelancer ? 'text-[#0E756D]' : 'text-violet-700';
    $accentHover = $isFreelancer ? 'hover:text-[#0E756D]' : 'hover:text-violet-700';
    $accentButton = $isFreelancer ? 'bg-[#0E756D] hover:bg-[#12514C]' : 'bg-violet-700 hover:bg-violet-800';
    $accentBadge = $isFreelancer ? 'bg-[#E0F5F1] text-[#12514C]' : 'bg-violet-50 text-violet-800';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="{{ $isFreelancer ? '#12514c' : '#f8fafc' }}">
    <title>Manajemen Kategori - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen {{ $isFreelancer ? 'bg-[#F2FAF9] text-[#183B3A]' : 'bg-slate-50 text-slate-900' }}">
@if ($isFreelancer)
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
                   href="{{ route('jasa.index') }}">Jasa Saya</a>
                <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
                   href="{{ route('portfolios.index') }}">Portofolio</a>
                <a class="inline-flex shrink-0 items-center rounded-lg bg-[#12514C] px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#0E756D]"
                   href="{{ route('categories.index') }}" aria-current="page">Kategori</a>
                <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
                   href="{{ route('freelancer.dashboard') }}">Dashboard</a>
            </div>
        </nav>
    </header>
@endif
<main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
    @unless ($isFreelancer)
        <nav class="flex items-center justify-between gap-4">
            <a class="text-xl font-extrabold tracking-tight {{ $accentText }}" href="{{ url('/') }}">FreelanceHub</a>
            @if (auth()->user()->role === 'admin')
                <div class="flex flex-wrap gap-3">
                    <a class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100"
                       href="{{ route('admin.jasa.index') }}">Kelola jasa</a>
                    <a class="inline-flex items-center rounded-lg {{ $accentButton }} px-4 py-2 text-sm font-semibold text-white"
                       href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
            @else
                <a class="text-sm font-semibold text-slate-600 hover:text-violet-700" href="{{ route('client.orders.index') }}">Pesanan saya</a>
            @endif
        </nav>
    @endunless

    @if (session('success'))
        <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900" role="alert">{{ session('error') }}</div>
    @endif

    <header class="mt-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide {{ $accentText }}">
                {{ $isFreelancer ? 'Workspace Freelancer' : 'Pengelolaan marketplace' }}
            </p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Kategori jasa</h1>
            <p class="mt-3 max-w-2xl leading-6 text-slate-600">
                {{ $isFreelancer
                    ? 'Jelajahi kategori untuk mengelompokkan dan menemukan jasa yang relevan.'
                    : 'Kelola kategori yang digunakan freelancer untuk mengelompokkan layanannya.' }}
            </p>
        </div>
        @if (auth()->user()->role === 'admin')
            <a class="inline-flex items-center justify-center rounded-xl {{ $accentButton }} px-5 py-3 font-semibold text-white"
               href="{{ route('categories.create') }}">+ Tambah kategori</a>
        @endif
    </header>

    <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h2 class="font-bold">Semua kategori</h2>
            <span class="rounded-full px-3 py-1 text-sm font-semibold {{ $accentBadge }}">{{ $categories->sum(fn ($category) => 1 + $category->children->count()) }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[620px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Kategori / subkategori</th>
                        <th class="px-5 py-4 font-semibold">Slug</th>
                        <th class="px-5 py-4 font-semibold">Jasa</th>
                        @if (auth()->user()->role === 'admin')
                            <th class="px-5 py-4 font-semibold">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($categories as $category)
                        <tr>
                            <td class="px-5 py-4 font-semibold">{{ $category->category_name }} <span class="text-xs text-slate-500">(utama)</span></td>
                            <td class="px-5 py-4 text-slate-600">{{ $category->slug }}</td>
                            <td class="px-5 py-4">
                                <a class="font-semibold {{ $accentText }} hover:underline"
                                   href="{{ route('categories.services', ['category' => $category->slug]) }}">
                                    Lihat {{ $category->services_count + $category->children->sum('services_count') }} jasa
                                </a>
                            </td>
                            @if (auth()->user()->role === 'admin')
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-4">
                                        <a class="font-semibold {{ $accentText }} hover:underline"
                                           href="{{ route('categories.edit', $category) }}">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                              onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="font-semibold text-red-700 hover:underline" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @foreach ($category->children as $child)
                            <tr class="bg-slate-50/70">
                                <td class="px-5 py-4 pl-10 font-medium text-slate-700">↳ {{ $child->category_name }}</td>
                                <td class="px-5 py-4 text-slate-600">{{ $child->slug }}</td>
                                <td class="px-5 py-4">
                                    <a class="font-semibold {{ $accentText }} hover:underline"
                                       href="{{ route('categories.services', ['category' => $child->slug]) }}">
                                        Lihat {{ $child->services_count }} jasa
                                    </a>
                                </td>
                                @if (auth()->user()->role === 'admin')
                                    <td class="px-5 py-4">
                                        <div class="flex items-center gap-4">
                                            <a class="font-semibold {{ $accentText }} hover:underline"
                                               href="{{ route('categories.edit', $child) }}">Edit</a>
                                            <form action="{{ route('categories.destroy', $child) }}" method="POST"
                                                  onsubmit="return confirm('Hapus subkategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="font-semibold text-red-700 hover:underline" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td class="px-5 py-12 text-center text-slate-500" colspan="{{ auth()->user()->role === 'admin' ? 4 : 3 }}">
                                Belum ada kategori. Tambahkan kategori pertama untuk mengelompokkan jasa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>
