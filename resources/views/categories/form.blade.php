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
        label { display: block; font-weight: bold; margin-bottom: 6px; }
        input { width: 100%; box-sizing: border-box; padding: 10px; margin-bottom: 16px; }
        .button { background: #6b4f3a; color: #fff; padding: 10px 15px; border: 0; border-radius: 5px; }
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
        <label for="category_name">Nama kategori</label>
        <input id="category_name" name="category_name" value="{{ old('category_name', $category?->category_name) }}" required>
        <button class="button" type="submit">Simpan</button>
        <a href="{{ route('categories.index') }}">Batal</a>
    </form>
</main>
</body>
</html>
