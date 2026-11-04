<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }} - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<main class="mx-auto max-w-4xl px-4 py-10 sm:px-6">
    <a class="text-sm font-semibold text-violet-700 hover:text-violet-900" href="{{ route('jasa.index') }}">← Kembali ke jasa saya</a>
    <header class="mt-6">
        <p class="text-sm font-semibold uppercase tracking-wide text-violet-700">Freelancer</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight">{{ $heading }}</h1>
        <p class="mt-2 text-slate-600">Atur detail layanan, foto, dan manfaat pada setiap paket.</p>
    </header>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
            <p class="font-semibold">Periksa kembali data berikut:</p>
            <ul class="mt-2 list-inside list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="mt-8 space-y-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8"
          action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <section class="grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold" for="title">Nama jasa</label>
                <input class="mt-2 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                       name="title" id="title" value="{{ old('title', $jasa?->title) }}" required maxlength="255">
            </div>
            <div>
                <label class="text-sm font-semibold" for="category_id">Kategori</label>
                <select class="mt-2 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                        name="category_id" id="category_id" required>
                    <option value="">Pilih kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $jasa?->category_id) == $category->id)>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold" for="main_image">Foto utama</label>
                <input class="mt-2 block w-full rounded-lg border border-slate-300 p-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-violet-50 file:px-3 file:py-2 file:font-semibold file:text-violet-700"
                       type="file" name="main_image" id="main_image" accept="image/jpeg,image/png,image/webp"
                       @required(! $jasa)>
                @if ($jasa?->mainImageUrl())
                    <img class="mt-3 h-24 w-36 rounded-lg object-cover" src="{{ $jasa->mainImageUrl() }}" alt="Foto jasa saat ini">
                @endif
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold" for="description">Deskripsi jasa</label>
                <textarea class="mt-2 min-h-36 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                          name="description" id="description" required maxlength="10000">{{ old('description', $jasa?->description) }}</textarea>
            </div>
            <div class="sm:col-span-2">
                <label class="text-sm font-semibold" for="gallery_images">Galeri foto (maksimal 8 foto)</label>
                <input class="mt-2 block w-full rounded-lg border border-slate-300 p-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-violet-50 file:px-3 file:py-2 file:font-semibold file:text-violet-700"
                       type="file" name="gallery_images[]" id="gallery_images" accept="image/jpeg,image/png,image/webp" multiple>
                <p class="mt-1 text-xs text-slate-500">Unggah foto baru saat mengedit untuk mengganti seluruh galeri.</p>
                @if ($jasa?->galleryImageUrls())
                    <div class="mt-3 flex flex-wrap gap-2">
                        @foreach ($jasa->galleryImageUrls() as $imageUrl)
                            <img class="h-16 w-20 rounded-md object-cover" src="{{ $imageUrl }}" alt="Foto galeri jasa">
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section>
            <h2 class="text-lg font-bold">Paket dan harga</h2>
            <div class="mt-4 grid gap-5 md:grid-cols-3">
                @foreach ([
                    'basic' => ['label' => 'Basic', 'price' => 'price', 'features' => 'basic_features'],
                    'plus' => ['label' => 'Plus', 'price' => 'plus_price', 'features' => 'plus_features'],
                    'premium' => ['label' => 'Premium', 'price' => 'premium_price', 'features' => 'premium_features'],
                ] as $package)
                    <fieldset class="rounded-xl border border-slate-200 p-4">
                        <legend class="px-1 font-semibold">{{ $package['label'] }}</legend>
                        <label class="mt-2 block text-sm" for="{{ $package['price'] }}">Harga (Rp)</label>
                        <input class="mt-1 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                               type="number" min="0" step="1000" name="{{ $package['price'] }}" id="{{ $package['price'] }}"
                               value="{{ old($package['price'], $jasa?->{$package['price']}) }}" required>
                        <label class="mt-4 block text-sm" for="{{ $package['features'] }}">Manfaat (satu per baris)</label>
                        <textarea class="mt-1 min-h-32 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                                  name="{{ $package['features'] }}" id="{{ $package['features'] }}" required>{{ old($package['features'], implode("\n", $jasa?->{$package['features']} ?? [])) }}</textarea>
                    </fieldset>
                @endforeach
            </div>
        </section>

        <div class="flex flex-wrap gap-3">
            <button class="rounded-lg bg-violet-700 px-5 py-3 font-semibold text-white hover:bg-violet-800 focus:outline-2 focus:outline-offset-2 focus:outline-violet-700"
                    type="submit">Simpan jasa</button>
            <a class="rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50"
               href="{{ route('jasa.index') }}">Batal</a>
        </div>
    </form>
</main>
</body>
</html>
