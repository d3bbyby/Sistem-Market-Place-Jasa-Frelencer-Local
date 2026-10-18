<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #F7F6FF; color: #30264B; }
        .container { max-width: 600px; margin: 40px auto; padding: 20px; }
        form { background: #fff; padding: 28px; border: 1px solid #E9E5F5; border-radius: 14px; box-shadow: 0 8px 24px rgba(48,38,75,.04); }
        label { display: block; font-weight: bold; margin: 14px 0 6px; }
        input, select { width: 100%; box-sizing: border-box; padding: 11px 12px; margin-top: 6px; border: 1px solid #E9E5F5; border-radius: 8px; color: #30264B; font: inherit; }
        input:focus, select:focus { outline: 2px solid #D9CCFF; border-color: #7047EB; }
        .button { background: #7047EB; color: #fff; border: 0; border-radius: 8px; padding: 11px 16px; margin-top: 20px; cursor: pointer; }
        .button:hover { background: #5030B5; }
        .errors { color: #b91c1c; }
        @media (max-width: 640px) { .container { margin: 20px auto; padding: 16px; } form { padding: 20px; } }
    </style>
</head>
<body>
<main class="container">
    <h1>{{ $heading }}</h1>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $formAction }}" method="POST">
        @csrf
        @if ($formMethod !== 'POST')
            @method($formMethod)
        @endif

        <label for="service_id">Jasa</label>
        <select id="service_id" name="service_id" required>
            <option value="">Pilih jasa</option>
            @foreach ($services as $service)
                <option value="{{ $service->id }}" @selected(old('service_id', $portfolio?->service_id) == $service->id)>
                    {{ $service->title }}
                </option>
            @endforeach
        </select>

        <label for="file_path">Path atau URL file</label>
        <input id="file_path" name="file_path" value="{{ old('file_path', $portfolio?->file_path) }}" required>

        <label for="caption">Caption</label>
        <input id="caption" name="caption" value="{{ old('caption', $portfolio?->caption) }}" required>

        <button class="button" type="submit">Simpan</button>
        <a href="{{ route('portfolios.index') }}">Batal</a>
    </form>
</main>
</body>
</html>
