<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $heading }}</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f3ee; }
        .container { max-width: 600px; margin: 40px auto; padding: 20px; }
        form { background: #fff; padding: 24px; border-radius: 8px; }
        label { display: block; font-weight: bold; margin: 14px 0 6px; }
        input, select { width: 100%; box-sizing: border-box; padding: 10px; }
        .button { background: #6b4f3a; color: #fff; border: 0; border-radius: 5px; padding: 10px 15px; margin-top: 20px; }
        .errors { color: #b91c1c; }
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
