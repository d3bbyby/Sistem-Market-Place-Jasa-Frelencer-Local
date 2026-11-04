<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }} - FreelanceHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
<main class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
    <a class="text-sm font-semibold text-violet-700 hover:text-violet-900" href="{{ route('portfolios.index') }}">← Kembali ke portofolio</a>
    <h1 class="mt-6 text-3xl font-bold tracking-tight">{{ $heading }}</h1>
    <p class="mt-2 text-slate-600">Ceritakan hasil karyamu agar calon klien mendapat gambaran yang jelas.</p>

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

    <form class="mt-7 space-y-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8"
          action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <div>
            <label class="text-sm font-semibold" for="title">Judul karya</label>
            <input class="mt-2 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                   id="title" name="title" value="{{ old('title', $portfolio?->title ?? $portfolio?->caption) }}" required maxlength="255">
        </div>

        <div>
            <label class="text-sm font-semibold" for="description">Deskripsi</label>
            <textarea class="mt-2 min-h-32 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                      id="description" name="description" maxlength="5000">{{ old('description', $portfolio?->description) }}</textarea>
        </div>

        <div>
            <label class="text-sm font-semibold" for="image">Gambar karya</label>
            <input class="mt-2 block w-full rounded-lg border border-slate-300 p-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-violet-50 file:px-3 file:py-2 file:font-semibold file:text-violet-700"
                   id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp"
                   @if (! $portfolio) required @endif>
            <p class="mt-1 text-xs text-slate-500">Format JPG, PNG, atau WebP; maksimal 5 MB.</p>
            @if ($portfolio?->imageUrl())
                <img class="mt-3 aspect-video max-h-56 rounded-xl object-cover" src="{{ $portfolio->imageUrl() }}"
                     alt="{{ $portfolio->title ?? $portfolio->caption }}">
            @endif
        </div>

        <div>
            <label class="text-sm font-semibold" for="project_link">Tautan proyek (opsional)</label>
            <input class="mt-2 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                   id="project_link" name="project_link" type="url" value="{{ old('project_link', $portfolio?->project_link) }}"
                   placeholder="https://contoh.com/proyek">
        </div>

        <div>
            <label class="text-sm font-semibold" for="service_id">Jasa terkait (opsional)</label>
            <select class="mt-2 w-full rounded-lg border-slate-300 focus:border-violet-600 focus:ring-violet-600"
                    id="service_id" name="service_id">
                <option value="">Tidak dikaitkan dengan jasa tertentu</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" @selected(old('service_id', $portfolio?->service_id) == $service->id)>
                        {{ $service->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
            <button class="rounded-lg bg-violet-700 px-5 py-3 font-semibold text-white hover:bg-violet-800"
                    type="submit">Simpan karya</button>
            <a class="rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50"
               href="{{ route('portfolios.index') }}">Batal</a>
        </div>
    </form>
</main>
</body>
</html>
