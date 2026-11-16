<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#12514c">
    <title>{{ $heading }} - FreelanceHub</title>
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
            <a class="inline-flex shrink-0 items-center rounded-lg bg-[#12514C] px-3 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-[#0E756D]"
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

<main class="mx-auto max-w-4xl px-4 py-8 sm:px-6 sm:py-10">
    <nav class="flex items-center gap-2 text-sm text-[#72918D]" aria-label="Breadcrumb">
        <a class="font-semibold text-[#0E756D] transition hover:text-[#12514C]" href="{{ route('jasa.index') }}">Jasa Saya</a>
        <span aria-hidden="true">/</span>
        <span class="font-medium text-[#183B3A]" aria-current="page">{{ $heading }}</span>
    </nav>

    <header class="mt-6">
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-[#0E756D]">Workspace Freelancer</p>
        <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-[#183B3A]">{{ $heading }}</h1>
        <p class="mt-2 leading-6 text-[#72918D]">Atur detail layanan, foto, dan manfaat pada setiap paket.</p>
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

    <form class="mt-7 space-y-8 rounded-2xl border border-[#D8EAE7] bg-white p-5 shadow-sm sm:p-8"
          action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <section class="grid gap-5 sm:grid-cols-2" aria-label="Informasi jasa">
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold text-[#183B3A]" for="title">Nama jasa</label>
                <input class="mt-2 w-full rounded-xl border border-[#C7DCD8] px-4 py-3 text-sm text-[#183B3A] outline-none focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                       name="title" id="title" value="{{ old('title', $jasa?->title) }}" required maxlength="255">
            </div>
            <div>
                <label class="text-sm font-semibold text-[#183B3A]" for="category_id">Kategori</label>
                <select class="mt-2 w-full rounded-xl border border-[#C7DCD8] bg-white px-4 py-3 text-sm text-[#183B3A] outline-none focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                        name="category_id" id="category_id" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $jasa?->category_id) == $category->id)>
                            {{ $category->parent ? $category->parent->category_name.' → ' : '' }}{{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-[#183B3A]" for="main_image">Foto utama</label>
                <input class="mt-2 block w-full rounded-xl border border-[#C7DCD8] p-2 text-sm text-[#315B57] file:mr-3 file:rounded-lg file:border-0 file:bg-[#E0F5F1] file:px-3 file:py-2 file:font-semibold file:text-[#12514C]"
                       type="file" name="main_image" id="main_image" accept="image/jpeg,image/png,image/webp"
                       @required(! $jasa)>
                @if ($jasa?->mainImageUrl())
                    <img class="mt-3 h-24 w-36 rounded-xl border border-[#D8EAE7] object-cover"
                         src="{{ $jasa->mainImageUrl() }}" alt="Foto jasa saat ini">
                @endif
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold text-[#183B3A]" for="description">Deskripsi jasa</label>
                <textarea class="mt-2 min-h-36 w-full rounded-xl border border-[#C7DCD8] px-4 py-3 text-sm leading-6 text-[#183B3A] outline-none focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                          name="description" id="description" required maxlength="10000">{{ old('description', $jasa?->description) }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold text-[#183B3A]" for="gallery_images">Galeri foto (maksimal 8 foto)</label>
                <input class="mt-2 block w-full rounded-xl border border-[#C7DCD8] p-2 text-sm text-[#315B57] file:mr-3 file:rounded-lg file:border-0 file:bg-[#E0F5F1] file:px-3 file:py-2 file:font-semibold file:text-[#12514C]"
                       type="file" name="gallery_images[]" id="gallery_images" accept="image/jpeg,image/png,image/webp" multiple>
                <p class="mt-2 text-xs leading-5 text-[#72918D]">Unggah foto baru saat mengedit untuk mengganti seluruh galeri.</p>
                @if ($jasa?->galleryImageUrls())
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($jasa->galleryImageUrls() as $imageUrl)
                            <img class="h-16 w-20 rounded-lg border border-[#D8EAE7] object-cover"
                                 src="{{ $imageUrl }}" alt="Foto galeri jasa">
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section aria-labelledby="packages-heading">
            <div class="border-b border-[#E8F2F0] pb-3">
                <h2 class="text-lg font-bold text-[#183B3A]" id="packages-heading">Paket dan harga</h2>
                <p class="mt-1 text-sm text-[#72918D]">Atur harga dan manfaat yang didapat klien pada setiap paket.</p>
            </div>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                @foreach ([
                    'basic' => ['label' => 'Basic', 'price' => 'price', 'features' => 'basic_features'],
                    'plus' => ['label' => 'Plus', 'price' => 'plus_price', 'features' => 'plus_features'],
                    'premium' => ['label' => 'Premium', 'price' => 'premium_price', 'features' => 'premium_features'],
                ] as $package)
                    <fieldset class="min-w-0 rounded-xl border border-[#D8EAE7] bg-[#F8FCFB] p-4">
                        <legend class="rounded-md bg-[#E0F5F1] px-2 py-1 text-sm font-bold text-[#12514C]">{{ $package['label'] }}</legend>
                        <label class="mt-2 block text-sm font-semibold text-[#183B3A]" for="{{ $package['price'] }}">Harga (Rp)</label>
                        <input class="mt-1 w-full rounded-lg border border-[#C7DCD8] bg-white px-3 py-2.5 text-sm text-[#183B3A] outline-none focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                               type="number" min="0" step="1000" name="{{ $package['price'] }}" id="{{ $package['price'] }}"
                               value="{{ old($package['price'], $jasa?->{$package['price']}) }}" required>
                        <label class="mt-4 block text-sm font-semibold text-[#183B3A]" for="{{ $package['features'] }}">Manfaat (satu per baris)</label>
                        <textarea class="mt-1 min-h-32 w-full rounded-lg border border-[#C7DCD8] bg-white px-3 py-2.5 text-sm leading-6 text-[#183B3A] outline-none focus:border-[#0E756D] focus:ring-4 focus:ring-[#0E756D]/15"
                                  name="{{ $package['features'] }}" id="{{ $package['features'] }}" required>{{ old($package['features'], implode("\n", $jasa?->{$package['features']} ?? [])) }}</textarea>
                    </fieldset>
                @endforeach
            </div>
        </section>

        <div class="flex flex-col-reverse gap-3 border-t border-[#E8F2F0] pt-5 sm:flex-row sm:justify-end">
            <a class="inline-flex items-center justify-center rounded-xl border border-[#C7DCD8] px-5 py-3 font-semibold text-[#315B57] transition hover:bg-[#F2FAF9]"
               href="{{ route('jasa.index') }}">Batal</a>
            <button class="rounded-xl bg-[#0E756D] px-5 py-3 font-semibold text-white transition hover:bg-[#12514C] focus:outline-2 focus:outline-offset-2 focus:outline-[#0E756D]"
                    type="submit">{{ $formMethod === 'POST' ? 'Simpan jasa' : 'Simpan perubahan' }}</button>
        </div>
    </form>
</main>
</body>
</html>
