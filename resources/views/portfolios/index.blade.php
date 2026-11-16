<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#12514c">
    <title>Portofolio Saya - FreelanceHub</title>
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

<main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:py-12">
    @if (session('success'))
        <div class="mt-6 rounded-xl border border-[#B8DFD9] bg-[#E0F5F1] p-4 text-[#12514C]" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-800" role="alert">{{ session('error') }}</div>
    @endif

    <header class="mt-10 flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-wide text-[#0E756D]">Workspace Freelancer</p>
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-[#183B3A] sm:text-4xl">Portofolio Saya</h1>
            <p class="mt-3 max-w-2xl leading-6 text-[#72918D]">Tampilkan hasil karya terbaik untuk membantu klien memahami kualitas pekerjaanmu.</p>
        </div>
        <a class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0E756D] px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D]"
           href="{{ route('portfolios.create') }}"><span aria-hidden="true">+</span> Tambah karya</a>
    </header>

    <section class="mt-8 grid gap-4 sm:grid-cols-2" aria-label="Ringkasan portofolio">
        <div class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Total karya</p>
            <p class="mt-1 text-3xl font-extrabold text-[#183B3A]">{{ $portfolios->count() }}</p>
        </div>
        <div class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Karya terkait jasa</p>
            <p class="mt-1 text-3xl font-extrabold text-[#183B3A]">{{ $portfolios->whereNotNull('service_id')->count() }}</p>
        </div>
    </section>

    <section class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3" aria-label="Daftar portofolio">
        @forelse ($portfolios as $portfolio)
            <article class="group overflow-hidden rounded-2xl border border-[#D8EAE7] bg-white shadow-sm transition duration-200 hover:-translate-y-1 hover:border-[#B8DFD9] hover:shadow-lg">
                @if ($portfolio->imageUrl())
                    <img class="aspect-[16/10] w-full object-cover transition duration-300 group-hover:scale-[1.02]" src="{{ $portfolio->imageUrl() }}"
                         alt="{{ $portfolio->title ?? $portfolio->caption }}">
                @else
                    <div class="grid aspect-[16/10] place-items-center bg-gradient-to-br from-[#E0F5F1] to-[#F2FAF9] text-3xl text-[#0E756D]" aria-hidden="true">✦</div>
                @endif
                <div class="p-5">
                    <h2 class="text-lg font-bold leading-snug text-[#183B3A]">{{ $portfolio->title ?? $portfolio->caption }}</h2>
                    @if ($portfolio->description)
                        <p class="mt-2 line-clamp-3 text-sm leading-6 text-[#72918D]">{{ $portfolio->description }}</p>
                    @endif
                    <div class="mt-3 flex items-center gap-2" aria-label="Rating portofolio">
                        <span class="font-semibold text-amber-500" aria-hidden="true">★</span>
                        @if ($portfolio->ratings_count > 0)
                            <span class="text-sm font-bold text-[#183B3A]">{{ number_format((float) $portfolio->ratings_avg_rating, 1) }}</span>
                            <span class="text-sm text-[#72918D]">dari {{ $portfolio->ratings_count }} rating</span>
                        @else
                            <span class="text-sm text-[#72918D]">Belum ada rating</span>
                        @endif
                    </div>
                    @if ($portfolio->service)
                        <p class="mt-3 text-sm text-[#72918D]">Jasa terkait: {{ $portfolio->service->title }}</p>
                        <p class="mt-1 text-sm text-[#72918D]">
                            Kategori: {{ $portfolio->service->category?->category_name ?? 'Tanpa kategori' }}
                        </p>
                    @endif
                    @if ($portfolio->project_link)
                        <a class="mt-3 inline-block text-sm font-semibold text-[#0E756D] hover:underline"
                           href="{{ $portfolio->project_link }}" target="_blank" rel="noopener noreferrer">Lihat proyek ↗</a>
                    @endif
                    <div class="mt-5 flex items-center justify-between border-t border-[#E8F2F0] pt-4">
                        <a class="text-sm font-semibold text-[#0E756D] hover:underline"
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
            <div class="rounded-2xl border border-dashed border-[#B8DFD9] bg-white p-10 text-center sm:col-span-2 lg:col-span-3">
                <span class="mx-auto grid size-12 place-items-center rounded-2xl bg-[#E0F5F1] text-xl font-bold text-[#0E756D]" aria-hidden="true">+</span>
                <h2 class="mt-4 text-lg font-bold text-[#183B3A]">Portofolio masih kosong</h2>
                <p class="mt-2 text-[#72918D]">Tambahkan hasil karya untuk membantu klien melihat kualitas pekerjaanmu.</p>
                <a class="mt-5 inline-flex rounded-lg bg-[#0E756D] px-4 py-2.5 font-semibold text-white transition hover:bg-[#12514C]"
                   href="{{ route('portfolios.create') }}">Tambah karya pertama</a>
            </div>
        @endforelse
    </section>
</main>
</body>
</html>
