<!DOCTYPE html>
<html lang="id"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>{{ $heading }}</title>
<style>body{font-family:Arial,sans-serif;background:#f8f3ee}.container{max-width:650px;margin:40px auto;padding:20px}form{background:#fff;padding:24px;border-radius:8px}label{display:block;margin-top:14px;font-weight:bold}input,select,textarea{box-sizing:border-box;width:100%;padding:10px;margin-top:6px;border:1px solid #ccc;border-radius:5px}textarea{min-height:120px}.button{background:#6b4f3a;color:#fff;border:0;border-radius:5px;padding:10px 16px;margin-top:20px;cursor:pointer}.error{color:#b91c1c;font-size:13px}</style></head>
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