
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#12514c">
    <title>Pesanan Masuk - FreelanceHub</title>
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
               href="{{ route('jasa.index') }}">Jasa Saya</a>

            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('portfolios.index') }}">Portofolio</a>

            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('categories.index') }}">Kategori</a>

            <a class="inline-flex shrink-0 items-center rounded-lg bg-[#12514C] px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#0E756D]"
               href="{{ route('freelancer.orders.index') }}" aria-current="page">Pesanan Masuk</a>

            <a class="inline-flex shrink-0 items-center rounded-lg px-3 py-2 text-sm font-semibold text-[#315B57] transition hover:bg-[#E0F5F1] hover:text-[#12514C]"
               href="{{ route('freelancer.dashboard') }}">Dashboard</a>
        </div>
    </nav>
</header>

@php
    $statusDetails = [
        'MENUNGGU' => ['label' => 'Menunggu diproses', 'classes' => 'border-amber-200 bg-amber-50 text-amber-800'],
        'DIPROSES' => ['label' => 'Sedang diproses', 'classes' => 'border-sky-200 bg-sky-50 text-sky-800'],
        'SUBMITTED' => ['label' => 'Menunggu persetujuan', 'classes' => 'border-cyan-200 bg-cyan-50 text-cyan-800'],
        'REVISI' => ['label' => 'Perlu revisi', 'classes' => 'border-orange-200 bg-orange-50 text-orange-800'],
        'SELESAI' => ['label' => 'Selesai', 'classes' => 'border-emerald-200 bg-emerald-50 text-emerald-800'],
    ];
@endphp

<main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:py-12">

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-[#B8DFD9] bg-[#E0F5F1] p-4 text-sm text-[#12514C]" role="status">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <header>
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#0E756D]">Workspace Freelancer</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#183B3A] sm:text-4xl">Pesanan Masuk</h1>
        <p class="mt-3 max-w-2xl leading-6 text-[#72918D]">
            Pantau pesanan, proses pekerjaan, dan kirim hasil kepada klien.
        </p>
    </header>

    {{-- Ringkasan Pesanan --}}
    <section class="mt-8 grid gap-4 sm:grid-cols-3" aria-label="Ringkasan pesanan">

        <article class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Total pesanan</p>
            <p class="mt-2 text-3xl font-extrabold text-[#183B3A]">{{ $orders->count() }}</p>
        </article>

        <article class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Perlu ditindaklanjuti</p>
            <p class="mt-2 text-3xl font-extrabold text-[#183B3A]">
                {{ $orders->whereIn('status', ['MENUNGGU', 'REVISI', 'DIPROSES'])->count() }}
            </p>
        </article>

        <article class="rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-[#72918D]">Pesanan selesai</p>
            <p class="mt-2 text-3xl font-extrabold text-[#183B3A]">
                {{ $orders->where('status', 'SELESAI')->count() }}
            </p>
        </article>

    </section>

    {{-- Daftar Pesanan --}}
    <section class="mt-8 space-y-4" aria-label="Daftar pesanan">

        @forelse ($orders as $order)

            @php
                $status = $statusDetails[$order->status] ?? [
                    'label' => $order->status,
                    'classes' => 'border-slate-200 bg-slate-50 text-slate-700',
                ];
            @endphp

            <article class="overflow-hidden rounded-2xl border border-[#D8EAE7] bg-white shadow-sm">

                <header class="flex flex-col gap-4 border-b border-[#E8F2F0] bg-white px-5 py-5 sm:flex-row sm:items-start sm:justify-between sm:px-6">

                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-wide text-[#72918D]">Jasa dipesan</p>

                        <h2 class="mt-1 text-lg font-bold leading-snug text-[#183B3A]">
                            {{ $order->service?->title ?? 'Jasa telah dihapus' }}
                        </h2>

                        <p class="mt-2 text-sm text-[#72918D]">
                            Klien
                            <span class="font-semibold text-[#315B57]">{{ $order->client?->name ?? '-' }}</span>
                            <span class="mx-1" aria-hidden="true">·</span>
                            Pesanan #{{ $order->id }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit shrink-0 items-center rounded-full border px-3 py-1.5 text-xs font-bold {{ $status['classes'] }}">
                        {{ $status['label'] }}
                    </span>

                </header>

                <div class="grid gap-5 px-5 py-5 sm:grid-cols-2 sm:px-6 lg:grid-cols-3">

                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wide text-[#72918D]">Detail harga</h3>

                        @if ($order->package)
                            <p class="mt-2 text-sm text-[#315B57]">
                                Paket {{ ucfirst($order->package) }}
                            </p>
                        @endif

                        <p class="mt-1 text-lg font-extrabold text-[#0E756D]">
                            Rp{{ number_format((float) ($order->total_price ?? $order->service?->price ?? 0), 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wide text-[#72918D]">Portofolio terkait</h3>

                        <div class="mt-2 flex flex-wrap gap-2">
                            @forelse ($order->service?->portfolios ?? collect() as $portfolio)
                                <span class="rounded-lg bg-[#F2FAF9] px-3 py-1.5 text-sm font-medium text-[#315B57]">
                                    {{ $portfolio->title ?? $portfolio->caption }}
                                </span>
                            @empty
                                <p class="text-sm text-[#72918D]">Belum ada portofolio terkait.</p>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-wide text-[#72918D]">Catatan revisi</h3>

                        @if ($order->revision_notes)
                            <p class="mt-2 rounded-xl border border-orange-100 bg-orange-50 p-3 text-sm leading-5 text-orange-900">
                                {{ $order->revision_notes }}
                            </p>
                        @else
                            <p class="mt-2 text-sm text-[#72918D]">Tidak ada catatan revisi.</p>
                        @endif
                    </div>

                </div>

                {{-- Aksi Pesanan --}}
                <footer class="flex flex-col gap-4 border-t border-[#E8F2F0] bg-[#FBFDFC] px-5 py-4 sm:flex-row sm:items-end sm:justify-between sm:px-6">

                    @if (in_array($order->status, ['MENUNGGU', 'REVISI'], true))

                        <div>
                            <p class="text-sm font-semibold text-[#183B3A]">
                                {{ $order->status === 'REVISI' ? 'Klien meminta revisi.' : 'Pesanan baru siap dikerjakan.' }}
                            </p>

                            <p class="mt-1 text-xs text-[#72918D]">
                                Mulai proses untuk memberi tahu klien bahwa pekerjaan sedang dikerjakan.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('freelancer.orders.updateStatus', $order) }}">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="status" value="DIPROSES">

                            <button class="inline-flex w-full items-center justify-center rounded-xl bg-[#0E756D] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D] sm:w-auto"
                                    type="submit">
                                Mulai Proses
                            </button>
                        </form>

                    @elseif ($order->status === 'DIPROSES')

                        <div>
                            <p class="text-sm font-semibold text-[#183B3A]">Pekerjaan sedang diproses.</p>
                            <p class="mt-1 text-xs text-[#72918D]">
                                Unggah hasil pekerjaan untuk dikirim kepada klien (maksimal 10 MB).
                            </p>
                        </div>

                        <form class="w-full space-y-3 sm:max-w-sm"
                              method="POST"
                              action="{{ route('freelancer.orders.updateStatus', $order) }}"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="status" value="SUBMITTED">

                            <label class="block text-xs font-semibold text-[#315B57]"
                                   for="work-result-{{ $order->id }}">
                                File hasil
                            </label>

                            <input class="block w-full rounded-xl border border-[#C7DCD8] bg-white p-2 text-xs text-[#315B57] file:mr-3 file:rounded-lg file:border-0 file:bg-[#E0F5F1] file:px-3 file:py-2 file:font-semibold file:text-[#12514C]"
                                   id="work-result-{{ $order->id }}"
                                   type="file"
                                   name="work_result_file"
                                   accept=".pdf,.zip,.doc,.docx,.jpg,.jpeg,.png,.txt"
                                   required>

                            @error('work_result_file')
                                <p class="text-xs font-medium text-red-700">{{ $message }}</p>
                            @enderror

                            <button class="inline-flex w-full items-center justify-center rounded-xl bg-[#0E756D] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D]"
                                    type="submit">
                                Kirim Hasil
                            </button>

                        </form>

                    @else

                        <p class="text-sm font-medium text-[#72918D]">
                            {{ $order->status === 'SUBMITTED' ? 'Hasil sudah dikirim. Menunggu tanggapan klien.' : 'Pesanan ini sudah selesai.' }}
                        </p>

                        @if ($order->work_result_file)
                            <a class="inline-flex w-full items-center justify-center rounded-xl border border-[#B8DFD9] bg-white px-4 py-2.5 text-sm font-semibold text-[#12514C] transition hover:bg-[#E0F5F1] sm:w-auto"
                               href="{{ route('orders.deliverable', $order) }}">
                                Unduh Hasil
                            </a>
                        @endif

                    @endif

                </footer>

                {{-- Unduh Hasil Sebelumnya --}}
                @if (in_array($order->status, ['MENUNGGU', 'REVISI', 'DIPROSES'], true) && $order->work_result_file)
                    <div class="border-t border-[#E8F2F0] px-5 py-3 sm:px-6">
                        <a class="text-sm font-semibold text-[#0E756D] hover:text-[#12514C] hover:underline"
                           href="{{ route('orders.deliverable', $order) }}">
                            Unduh hasil sebelumnya
                        </a>
                    </div>
                @endif

                {{-- RATING UNTUK CLIENT --}}
                @if ($order->status === 'SELESAI')

                    @php
                        $freelancerRating = $order->ratings
                            ->firstWhere('reviewer_id', auth()->id());
                    @endphp

                    <div class="border-t border-[#E8F2F0] bg-[#FBFDFC] px-5 py-5 sm:px-6">

                        <div class="rounded-xl border border-[#B8DFD9] bg-[#F2FAF9] p-4">

                            @if ($freelancerRating)

                                <p class="text-sm font-bold text-[#12514C]">
                                    ✓ Kamu sudah memberikan rating kepada Client.
                                </p>

                                <p class="mt-2 text-sm text-[#315B57]">
                                    Rating kamu: {{ $freelancerRating->rating }} ⭐
                                </p>

                                @if ($freelancerRating->review)
                                    <p class="mt-2 text-sm text-[#72918D]">
                                        Ulasan: {{ $freelancerRating->review }}
                                    </p>
                                @endif

                            @else

                                <h3 class="text-base font-bold text-[#183B3A]">
                                    Berikan Rating untuk Client
                                </h3>

                                <p class="mt-1 text-sm text-[#72918D]">
                                    Berikan penilaian terhadap pengalaman bekerja dengan klien ini.
                                </p>

                                <form method="POST"
                                      action="{{ route('ratings.store', $order) }}"
                                      class="mt-4 space-y-3">

                                    @csrf

                                    <div>
                                        <label for="rating-{{ $order->id }}"
                                               class="mb-2 block text-sm font-semibold text-[#315B57]">
                                            Pilih Rating
                                        </label>

                                        <select id="rating-{{ $order->id }}"
                                                name="rating"
                                                required
                                                class="w-full rounded-xl border border-[#C7DCD8] bg-white px-3 py-2.5 text-sm text-[#315B57] focus:border-[#0E756D] focus:outline-none sm:max-w-xs">

                                            <option value="">Pilih Rating</option>
                                            <option value="5">5 - Sangat Baik ⭐</option>
                                            <option value="4">4 - Baik ⭐</option>
                                            <option value="3">3 - Cukup ⭐</option>
                                            <option value="2">2 - Kurang ⭐</option>
                                            <option value="1">1 - Sangat Kurang ⭐</option>

                                        </select>
                                    </div>

                                    <div>
                                        <label for="review-{{ $order->id }}"
                                               class="mb-2 block text-sm font-semibold text-[#315B57]">
                                            Ulasan (Opsional)
                                        </label>

                                        <textarea id="review-{{ $order->id }}"
                                                  name="review"
                                                  rows="3"
                                                  maxlength="1000"
                                                  placeholder="Tulis ulasan mengenai pengalaman bekerja dengan Client..."
                                                  class="w-full rounded-xl border border-[#C7DCD8] bg-white px-3 py-2.5 text-sm text-[#315B57] placeholder:text-[#9BB4B0] focus:border-[#0E756D] focus:outline-none"></textarea>
                                    </div>

                                    <button type="submit"
                                            class="inline-flex items-center justify-center rounded-xl bg-[#0E756D] px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D]">
                                        Kirim Rating
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @endif

            </article>

        @empty

            <div class="rounded-2xl border border-dashed border-[#B8DFD9] bg-white px-6 py-14 text-center">

                <span class="mx-auto grid size-14 place-items-center rounded-2xl bg-[#E0F5F1] text-2xl font-bold text-[#0E756D]" aria-hidden="true">
                    ✓
                </span>

                <h2 class="mt-4 text-lg font-bold text-[#183B3A]">
                    Belum ada pesanan masuk
                </h2>

                <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#72918D]">
                    Pesanan dari klien akan muncul di sini saat jasa kamu dipesan.
                </p>

                <a class="mt-5 inline-flex rounded-xl bg-[#0E756D] px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-[#12514C]"
                   href="{{ route('jasa.index') }}">
                    Kelola Jasa
                </a>

            </div>

        @endforelse

    </section>

</main>

</body>
</html>
