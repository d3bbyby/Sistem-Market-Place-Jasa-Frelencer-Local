<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#12514c">
    <title>{{ $heading }} - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#F2FAF9] text-[#183B3A]">
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
            <a class="inline-flex shrink-0 items-center rounded-lg bg-[#12514C] px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#0E756D]"
               href="{{ route('portfolios.index') }}" aria-current="page">Portofolio</a>
            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('categories.index') }}">Kategori</a>
            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('freelancer.dashboard') }}">Dashboard</a>
        </div>
    </nav>
</header>

<main class="mx-auto max-w-3xl px-4 py-8 sm:px-6 sm:py-10">
    <nav class="flex items-center gap-2 text-sm text-[#72918D]" aria-label="Breadcrumb">
        <a class="font-semibold text-[#0E756D] hover:text-[#12514C]" href="{{ route('portfolios.index') }}">Portofolio</a>
        <span aria-hidden="true">/</span>
        <span class="font-medium text-[#183B3A]" aria-current="page">{{ $heading }}</span>
    </nav>
    <header class="mt-6">
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#0E756D]">Workspace Freelancer</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#183B3A]">{{ $heading }}</h1>
        <p class="mt-2 leading-6 text-[#72918D]">Ceritakan hasil karyamu agar calon klien mendapat gambaran yang jelas.</p>
    </header>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
            <p class="font-semibold">Periksa kembali data berikut:</p>
            <ul class="mt-2 list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="mt-7 space-y-6 rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm sm:p-8"
          action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <div>
            <label class="block text-sm font-semibold text-slate-800" for="title">Judul karya</label>
            <input class="mt-2 block w-full rounded-xl border border-[#C7DCD8] bg-white px-4 py-3 text-sm text-[#183B3A] shadow-sm outline-none transition placeholder:text-[#91A8A4] focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                   id="title" name="title" value="{{ old('title', $portfolio?->title ?? $portfolio?->caption) }}" required maxlength="255">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-800" for="description">Deskripsi</label>
            <textarea class="mt-2 block min-h-36 w-full resize-y rounded-xl border border-[#C7DCD8] bg-white px-4 py-3 text-sm leading-6 text-[#183B3A] shadow-sm outline-none transition placeholder:text-[#91A8A4] focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                      id="description" name="description" maxlength="5000">{{ old('description', $portfolio?->description) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-800" for="image">Gambar karya</label>
            <input class="mt-2 block w-full rounded-xl border border-[#C7DCD8] bg-white p-2 text-sm text-slate-700 shadow-sm file:mr-3 file:rounded-lg file:border-0 file:bg-[#E0F5F1] file:px-3 file:py-2 file:font-semibold file:text-[#12514C]"
                   id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                   @if (! $portfolio) required @endif>
            <p class="mt-2 text-xs leading-5 text-[#72918D]">Format JPG, PNG, atau WebP; maksimal 5 MB.</p>
            @if ($portfolio?->imageUrl())
                <img class="mt-3 aspect-video max-h-56 rounded-xl border border-[#D8EAE7] object-cover" src="{{ $portfolio->imageUrl() }}"
                     alt="{{ $portfolio->title ?? $portfolio->caption }}">
            @endif
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-800" for="project_link">Tautan proyek (opsional)</label>
            <input class="mt-2 block w-full rounded-xl border border-[#C7DCD8] bg-white px-4 py-3 text-sm text-[#183B3A] shadow-sm outline-none transition placeholder:text-[#91A8A4] focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                   id="project_link" name="project_link" type="url" value="{{ old('project_link', $portfolio?->project_link) }}"
                   placeholder="https://contoh.com/proyek">
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-800" for="service_id">Jasa terkait</label>
            @if ($services->isEmpty())
                <p class="mt-2 rounded-xl border border-amber-200 bg-amber-50 p-4 text-sm leading-6 text-amber-800" role="alert">
                    Buat jasa terlebih dahulu sebelum menambahkan portofolio.
                    <a class="font-semibold underline" href="{{ route('jasa.create') }}">Tambah jasa</a>
                </p>
            @endif
            <select class="mt-2 block w-full rounded-xl border border-[#C7DCD8] bg-white px-4 py-3 text-sm text-[#183B3A] shadow-sm outline-none transition focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                    id="service_id" name="service_id" required>
                <option value="">Pilih jasa terkait</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" @selected(old('service_id', $portfolio?->service_id) == $service->id)>
                        {{ $service->title }} — {{ $service->category?->category_name ?? 'Tanpa kategori' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-[#E8F2F0] pt-5 sm:flex-row sm:justify-end">
            <a class="inline-flex items-center justify-center rounded-xl border border-[#C7DCD8] px-5 py-3 font-semibold text-[#183B3A] transition hover:bg-[#F2FAF9]"
               href="{{ route('portfolios.index') }}">Batal</a>
            <button class="rounded-xl bg-[#0E756D] px-5 py-3 font-semibold text-white transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D] disabled:cursor-not-allowed disabled:opacity-50"
                    type="submit" @disabled($services->isEmpty())>
                {{ $formMethod === 'POST' ? 'Simpan karya' : 'Simpan perubahan' }}
            </button>
        </div>
    </form>
</main>
</body>
</html>
