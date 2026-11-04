<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<nav class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6">
        <a class="text-xl font-extrabold tracking-tight text-violet-700" href="{{ url('/') }}">FreelanceHub</a>
        @auth
            @if (auth()->user()->role === 'client')
                <a class="text-sm font-semibold text-slate-700 hover:text-violet-700" href="{{ route('client.orders.index') }}">Pesanan Saya</a>
            @endif
        @else
            <a class="text-sm font-semibold text-slate-700 hover:text-violet-700" href="{{ route('login') }}">Masuk</a>
        @endauth
    </div>
</nav>

<main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:py-12">
    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="mb-6 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900" role="alert">{{ session('error') }}</div>
    @endif

    <a class="text-sm font-semibold text-violet-700 hover:text-violet-900" href="{{ url('/client/jasa') }}">← Kembali ke daftar jasa</a>
    <div class="mt-6 grid items-start gap-8 lg:grid-cols-[minmax(0,1fr)_380px]">
        <div class="space-y-7">
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                @if ($mainImageUrl)
                    <img id="main-service-image" class="aspect-[16/9] w-full object-cover" src="{{ $mainImageUrl }}" alt="Foto {{ $service->title }}">
                @else
                    <div id="main-service-placeholder" class="grid aspect-[16/9] place-items-center bg-gradient-to-br from-violet-100 via-indigo-50 to-fuchsia-100 px-6 text-center">
                        <div>
                            <span class="text-4xl" aria-hidden="true">✦</span>
                            <p class="mt-3 font-semibold text-violet-900">{{ $service->title }}</p>
                            <p class="mt-1 text-sm text-slate-600">Foto jasa belum tersedia</p>
                        </div>
                    </div>
                @endif
                @if ($mainImageUrl || count($galleryImageUrls) > 0)
                    <div class="flex gap-3 overflow-x-auto p-4" aria-label="Galeri foto jasa">
                        @if ($mainImageUrl)
                            <button class="shrink-0 overflow-hidden rounded-lg ring-2 ring-violet-600" type="button"
                                    data-gallery-image="{{ $mainImageUrl }}" aria-label="Tampilkan foto utama">
                                <img class="h-16 w-20 object-cover" src="{{ $mainImageUrl }}" alt="">
                            </button>
                        @endif
                        @foreach ($galleryImageUrls as $index => $imageUrl)
                            <button class="shrink-0 overflow-hidden rounded-lg ring-1 ring-slate-200 hover:ring-violet-500"
                                    type="button" data-gallery-image="{{ $imageUrl }}" aria-label="Tampilkan foto {{ $index + 1 }}">
                                <img class="h-16 w-20 object-cover" src="{{ $imageUrl }}" alt="">
                            </button>
                        @endforeach
                    </div>
                @endif
            </section>

            <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                @if ($service->category)
                    <a class="text-sm font-semibold text-violet-700 hover:underline"
                       href="{{ route('categories.services', ['category' => $service->category->slug]) }}">
                        {{ $service->category->category_name }}
                    </a>
                @else
                    <p class="text-sm font-semibold text-violet-700">Jasa freelance</p>
                @endif
                <h1 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">{{ $service->title }}</h1>
                <div class="mt-5 flex items-center gap-3 border-b border-slate-100 pb-6">
                    <span class="grid size-12 place-items-center rounded-full bg-violet-100 text-lg font-bold text-violet-800">
                        {{ mb_strtoupper(mb_substr($service->freelancer?->name ?? 'F', 0, 1)) }}
                    </span>
                    <div>
                        <p class="font-semibold">{{ $service->freelancer?->name ?? 'Freelancer' }}</p>
                        <p class="text-sm text-slate-500">Freelancer di FreelanceHub</p>
                    </div>
                </div>
                <h2 class="mt-7 text-xl font-bold">Tentang jasa ini</h2>
                <div class="mt-3 whitespace-pre-line leading-7 text-slate-700">{{ $service->description }}</div>
            </section>

            @if ($service->freelancer?->portfolios?->isNotEmpty())
                <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="text-xl font-bold">Karya freelancer</h2>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        @foreach ($service->freelancer->portfolios->take(4) as $portfolio)
                            <article class="overflow-hidden rounded-xl border border-slate-200">
                                @if ($portfolio->imageUrl())
                                    <img class="aspect-[16/10] w-full object-cover" src="{{ $portfolio->imageUrl() }}" alt="{{ $portfolio->title ?? $portfolio->caption }}">
                                @endif
                                <div class="p-4">
                                    <h3 class="font-semibold">{{ $portfolio->title ?? $portfolio->caption }}</h3>
                                    @if ($portfolio->description)
                                        <p class="mt-2 line-clamp-3 text-sm text-slate-600">{{ $portfolio->description }}</p>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <aside class="lg:sticky lg:top-6">
            <section class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">
                <h2 class="text-lg font-bold">Pilih paket</h2>
                <div class="mt-4 grid grid-cols-3 rounded-xl bg-slate-100 p-1" role="tablist" aria-label="Pilihan paket">
                    @foreach ($packages as $key => $package)
                        <button class="rounded-lg px-2 py-2 text-sm font-semibold transition {{ $key === 'basic' ? 'bg-white text-violet-800 shadow-sm' : '' }}"
                                type="button" role="tab" data-package-tab="{{ $key }}"
                                aria-selected="{{ $key === 'basic' ? 'true' : 'false' }}">
                            {{ $package['label'] }}
                        </button>
                    @endforeach
                </div>
                <p class="mt-5 text-sm text-slate-500">Harga paket</p>
                <p class="mt-1 text-3xl font-extrabold text-violet-800" id="package-price" aria-live="polite">
                    Rp{{ number_format($packages['basic']['price'], 0, ',', '.') }}
                </p>
                <h3 class="mt-6 font-semibold">Yang kamu dapatkan</h3>
                <ul class="mt-3 space-y-3 text-sm text-slate-700" id="package-features">
                    @foreach ($packages['basic']['features'] as $feature)
                        <li class="flex gap-2"><span class="font-bold text-emerald-600" aria-hidden="true">✓</span><span>{{ $feature }}</span></li>
                    @endforeach
                </ul>

                @auth
                    @if (auth()->user()->role === 'client')
                        <form class="mt-7" method="POST" action="{{ route('client.orders.store', $service) }}">
                            @csrf
                            <input id="selected-package" type="hidden" name="package" value="basic">
                            <button class="w-full rounded-xl bg-violet-700 px-5 py-3.5 font-bold text-white transition hover:bg-violet-800 focus:outline-2 focus:outline-offset-2 focus:outline-violet-700"
                                    type="submit">Beli Paket Ini</button>
                        </form>
                    @else
                        <p class="mt-7 rounded-xl bg-slate-100 p-4 text-sm text-slate-600">Masuk sebagai klien untuk memesan jasa ini.</p>
                    @endif
                @else
                    <a class="mt-7 block rounded-xl bg-violet-700 px-5 py-3.5 text-center font-bold text-white transition hover:bg-violet-800"
                       href="{{ route('login') }}">Masuk untuk membeli</a>
                @endauth

                @if ($service->freelancer?->email)
                    <a class="mt-3 block rounded-xl border border-violet-200 px-5 py-3 text-center font-semibold text-violet-800 hover:bg-violet-50"
                       href="mailto:{{ $service->freelancer->email }}?subject={{ rawurlencode('Pertanyaan tentang '.$service->title) }}">
                        Tanya Dulu
                    </a>
                @endif
            </section>
        </aside>
    </div>
</main>

<script>
    const packages = @js($packages);
    const selectedPackage = document.querySelector('#selected-package');
    const priceElement = document.querySelector('#package-price');
    const featureList = document.querySelector('#package-features');
    const packageTabs = document.querySelectorAll('[data-package-tab]');

    packageTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            const packageKey = tab.dataset.packageTab;
            const selected = packages[packageKey];

            if (selectedPackage) {
                selectedPackage.value = packageKey;
            }
            priceElement.textContent = `Rp${new Intl.NumberFormat('id-ID').format(selected.price)}`;
            featureList.replaceChildren(...selected.features.map((feature) => {
                const item = document.createElement('li');
                const check = document.createElement('span');
                const text = document.createElement('span');

                item.className = 'flex gap-2';
                check.className = 'font-bold text-emerald-600';
                check.setAttribute('aria-hidden', 'true');
                check.textContent = '✓';
                text.textContent = feature;
                item.append(check, text);

                return item;
            }));

            packageTabs.forEach((packageTab) => {
                const isSelected = packageTab === tab;

                packageTab.setAttribute('aria-selected', String(isSelected));
                packageTab.classList.toggle('bg-white', isSelected);
                packageTab.classList.toggle('text-violet-800', isSelected);
                packageTab.classList.toggle('shadow-sm', isSelected);
            });
        });
    });

    let mainImage = document.querySelector('#main-service-image');

    document.querySelectorAll('[data-gallery-image]').forEach((thumbnail) => {
        thumbnail.addEventListener('click', () => {
            if (mainImage) {
                mainImage.src = thumbnail.dataset.galleryImage;
                return;
            }

            const placeholder = document.querySelector('#main-service-placeholder');
            mainImage = document.createElement('img');
            mainImage.id = 'main-service-image';
            mainImage.className = 'aspect-[16/9] w-full object-cover';
            mainImage.src = thumbnail.dataset.galleryImage;
            mainImage.alt = @js('Foto '.$service->title);
            placeholder?.replaceWith(mainImage);
        });
    });
</script>
</body>
</html>
