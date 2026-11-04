<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<main class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:py-14">
    <nav class="flex items-center justify-between gap-4">
        <a class="text-xl font-extrabold tracking-tight text-violet-700" href="{{ url('/') }}">FreelanceHub</a>
        @if (auth()->user()->role === 'admin')
            <a class="text-sm font-semibold text-slate-600 hover:text-violet-700" href="{{ route('admin.dashboard') }}">Admin dashboard</a>
        @elseif (auth()->user()->role === 'freelancer')
            <a class="text-sm font-semibold text-slate-600 hover:text-violet-700" href="{{ route('freelancer.dashboard') }}">Dashboard freelancer</a>
        @else
            <a class="text-sm font-semibold text-slate-600 hover:text-violet-700" href="{{ route('client.orders.index') }}">Pesanan saya</a>
        @endif
    </nav>

    @if (session('success'))
        <div class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900" role="alert">{{ session('error') }}</div>
    @endif

    <header class="mt-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-violet-700">Pengelolaan marketplace</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Kategori jasa</h1>
            <p class="mt-3 text-slate-600">Kelola kategori yang digunakan freelancer untuk mengelompokkan layanannya.</p>
        </div>
        @if (auth()->user()->role === 'admin')
            <a class="inline-flex items-center justify-center rounded-xl bg-violet-700 px-5 py-3 font-semibold text-white hover:bg-violet-800"
               href="{{ route('categories.create') }}">+ Tambah kategori</a>
        @endif
    </header>

    <section class="mt-8 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <h2 class="font-bold">Semua kategori</h2>
            <span class="rounded-full bg-violet-50 px-3 py-1 text-sm font-semibold text-violet-800">{{ $categories->count() }}</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[620px] text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wide text-slate-500">
                    <tr>
                        <th class="px-5 py-4 font-semibold">Nama kategori</th>
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
                            <td class="px-5 py-4 font-semibold">{{ $category->category_name }}</td>
                            <td class="px-5 py-4 text-slate-600">{{ $category->slug }}</td>
                            <td class="px-5 py-4">
                                <a class="font-semibold text-violet-700 hover:underline"
                                   href="{{ route('categories.services', ['category' => $category->slug]) }}">
                                    Lihat {{ $category->services_count }} jasa
                                </a>
                            </td>
                            @if (auth()->user()->role === 'admin')
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-4">
                                        <a class="font-semibold text-violet-700 hover:underline"
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
