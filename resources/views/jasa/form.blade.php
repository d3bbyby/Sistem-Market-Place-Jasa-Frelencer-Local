<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>{{ $heading }}</title>
<style>
    :root {
        --ink: #30264B;
        --muted: #89829E;
        --line: #E9E5F5;
        --accent: #7047EB;
        --accent-dark: #5030B5;
        --background: #F7F6FF;
    }

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: var(--background);
        color: var(--ink);
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 650px;
        margin: 40px auto;
        padding: 20px;
    }

    h1 {
        margin-bottom: 20px;
    }

    form {
        padding: 28px;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(48, 38, 75, .04);
    }

    label {
        display: block;
        margin-top: 14px;
        font-weight: bold;
    }

    input,
    select,
    textarea {
        width: 100%;
        margin-top: 6px;
        padding: 11px 12px;
        border: 1px solid var(--line);
        border-radius: 8px;
        color: var(--ink);
        font: inherit;
    }

    input:focus,
    select:focus,
    textarea:focus {
        outline: 2px solid #D9CCFF;
        border-color: var(--accent);
    }

    textarea {
        min-height: 120px;
    }

    .button {
        margin-top: 20px;
        padding: 11px 16px;
        border: 0;
        border-radius: 8px;
        background: var(--accent);
        color: #fff;
        cursor: pointer;
        text-decoration: none;
    }

    .button:hover {
        background: var(--accent-dark);
    }

    .error {
        color: #b91c1c;
        font-size: 13px;
    }

    @media (max-width: 700px) {
        .container {
            margin: 20px auto;
            padding: 16px;
        }

        form {
            padding: 20px;
        }
    }
</style></head>
<body><main class="container"><h1>{{ $heading }}</h1>
@if ($errors->any())<div class="error"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form action="{{ $formAction }}" method="POST">@csrf @if ($formMethod !== 'POST') @method($formMethod) @endif
<label for="freelancer_id">Freelancer</label>
<select name="freelancer_id" id="freelancer_id" required>
	<option value="">Pilih freelancer</option>
	@foreach ($freelancers as $freelancer)
		<option value="{{ $freelancer->id }}" @selected(old('freelancer_id', $jasa?->freelancer_id) == $freelancer->id)>{{ $freelancer->name }}</option>
	@endforeach
</select>
<label for="category_id">Kategori</label>
<select name="category_id" id="category_id" required>
	<option value="">Pilih kategori</option>
	@foreach ($categories as $category)
		<option value="{{ $category->id }}" @selected(old('category_id', $jasa?->category_id) == $category->id)>{{ $category->category_name }}</option>
	@endforeach
</select>
<label for="title">Judul</label><input name="title" id="title" value="{{ old('title', $jasa?->title) }}" required>
<label for="description">Deskripsi</label><textarea name="description" id="description" required>{{ old('description', $jasa?->description) }}</textarea>
<label for="price">Harga</label><input type="number" min="0" step="0.01" name="price" id="price" value="{{ old('price', $jasa?->price) }}" required>
<button class="button" type="submit">Simpan</button> <a href="{{ route('jasa.index') }}">Batal</a>
</form></main></body></html>