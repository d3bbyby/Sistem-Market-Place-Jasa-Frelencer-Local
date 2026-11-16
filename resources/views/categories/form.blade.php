<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f8fafc">
    <title>{{ $heading }} - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<nav class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6">
        <a class="flex items-center gap-2 text-lg font-extrabold tracking-tight text-slate-900" href="{{ url('/') }}">
            <span class="grid size-9 place-items-center rounded-xl bg-violet-700 text-sm text-white">F</span>
            FreelanceHub
        </a>
        <div class="flex items-center gap-2 sm:gap-3">
            <a class="rounded-lg border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 transition hover:border-violet-200 hover:text-violet-700 sm:px-4"
               href="{{ route('categories.index') }}">Daftar kategori</a>
            <a class="hidden rounded-lg bg-violet-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-violet-800 sm:inline-flex"
               href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
    </div>
</nav>

<main class="mx-auto max-w-3xl px-4 py-8 sm:px-6 sm:py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-500" aria-label="Breadcrumb">
        <a class="font-medium hover:text-violet-700" href="{{ route('categories.index') }}">Kategori jasa</a>
        <span aria-hidden="true">/</span>
        <span class="font-semibold text-slate-800" aria-current="page">{{ $heading }}</span>
    </nav>

    <header class="mt-6 mb-7">
        <p class="text-xs font-bold uppercase tracking-[0.16em] text-violet-700">Pengelolaan marketplace</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-950 sm:text-4xl">{{ $heading }}</h1>
        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
            Buat kategori utama atau tempatkan kategori ini di bawah kategori yang sudah ada agar layanan mudah ditemukan.
        </p>
    </header>

    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5 text-red-900" role="alert">
            <div class="flex items-start gap-3">
                <span class="grid size-8 shrink-0 place-items-center rounded-full bg-red-100 text-sm font-bold text-red-700" aria-hidden="true">!</span>
                <div>
                    <h2 class="font-bold">Kategori belum dapat disimpan</h2>
                    <p class="mt-1 text-sm text-red-800">Periksa kembali informasi berikut:</p>
                    <ul class="mt-2 list-inside list-disc space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center gap-4 border-b border-slate-100 bg-gradient-to-r from-white to-violet-50/70 px-5 py-5 sm:px-7">
            <span class="grid size-11 shrink-0 place-items-center rounded-xl bg-violet-100 text-sm font-extrabold text-violet-800" aria-hidden="true">01</span>
            <div>
                <h2 class="font-bold text-slate-900">Informasi kategori</h2>
                <p class="mt-1 text-sm text-slate-500">Isi nama dan tentukan posisi kategori.</p>
            </div>
        </div>

        <form action="{{ $formAction }}" method="POST">
            @csrf
            @if ($formMethod !== 'POST')
                @method($formMethod)
            @endif

            <div class="space-y-6 px-5 py-6 sm:px-7 sm:py-7">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-800" for="category_name">
                        Nama kategori <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <input
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition placeholder:text-slate-400 focus:border-violet-500 focus:ring-4 focus:ring-violet-100 @error('category_name') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        id="category_name"
                        name="category_name"
                        type="text"
                        value="{{ old('category_name', $category?->category_name) }}"
                        placeholder="Contoh: Desain Grafis"
                        maxlength="255"
                        required
                        autofocus
                        aria-describedby="category-name-help"
                        @error('category_name') aria-invalid="true" @enderror
                    >
                    <p class="mt-2 text-sm leading-5 text-slate-500" id="category-name-help">
                        Gunakan nama yang singkat dan mudah dikenali oleh klien maupun freelancer.
                    </p>
                    @error('category_name')
                        <p class="mt-2 text-sm font-medium text-red-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-800" for="parent_category_id">Kategori induk</label>
                    <select
                        class="block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 shadow-sm outline-none transition focus:border-violet-500 focus:ring-4 focus:ring-violet-100 @error('parent_category_id') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror"
                        id="parent_category_id"
                        name="parent_category_id"
                        aria-describedby="parent-category-help"
                        @error('parent_category_id') aria-invalid="true" @enderror
                    >
                        <option value="">Jadikan kategori utama</option>
                        @foreach ($parentCategories as $parentCategory)
                            <option
                                value="{{ $parentCategory->id }}"
                                @selected((string) old('parent_category_id', $category?->parent_category_id) === (string) $parentCategory->id)
                            >
                                {{ $parentCategory->category_name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-sm leading-5 text-slate-500" id="parent-category-help">
                        Pilih kategori induk untuk membuat subkategori. Biarkan pilihan ini sebagai kategori utama jika tidak memiliki induk.
                    </p>
                    @if ($parentCategories->isEmpty())
                        <p class="mt-2 rounded-lg bg-slate-50 px-3 py-2 text-xs leading-5 text-slate-600">
                            Belum ada kategori induk lain yang tersedia. Kategori ini tetap dapat dibuat sebagai kategori utama.
                        </p>
                    @endif
                    @error('parent_category_id')
                        <p class="mt-2 text-sm font-medium text-red-700">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 bg-slate-50/70 px-5 py-4 sm:flex-row sm:justify-end sm:px-7">
                <a class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-slate-50"
                   href="{{ route('categories.index') }}">Batal</a>
                <button class="inline-flex items-center justify-center gap-2 rounded-xl bg-violet-700 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-violet-800 focus:outline-2 focus:outline-offset-2 focus:outline-violet-700"
                        type="submit">
                    <span aria-hidden="true">✓</span>
                    {{ $formMethod === 'POST' ? 'Simpan kategori' : 'Simpan perubahan' }}
                </button>
            </div>
        </form>
    </section>

    <p class="mt-5 text-center text-xs leading-5 text-slate-500">
        Kategori dan subkategori membantu pengguna menemukan layanan yang relevan.
    </p>
</main>
</body>
</html>
