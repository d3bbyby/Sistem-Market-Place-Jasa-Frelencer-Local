<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#7047eb">
    <title>{{ $heading }} - FreelanceHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand: #7047eb;
            --brand-dark: #5030b5;
            --ink: #30264b;
            --muted: #837b99;
            --line: #e9e5f5;
            --page: #f7f6ff;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(ellipse at 85% 0, #e9e2ff 0, transparent 34rem),
                var(--page);
            color: var(--ink);
        }

        .navbar-brand {
            color: var(--brand);
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .brand-mark {
            display: inline-grid;
            width: 2.25rem;
            height: 2.25rem;
            margin-right: .55rem;
            place-items: center;
            border-radius: .75rem;
            background: linear-gradient(135deg, #9878ff, #623bde);
            color: #fff;
        }

        .page-content {
            width: min(100% - 2rem, 720px);
            margin: 0 auto;
            padding: clamp(2rem, 7vw, 5rem) 0;
        }

        .breadcrumb-link {
            color: var(--muted);
            font-size: .9rem;
            font-weight: 600;
            text-decoration: none;
        }

        .breadcrumb-link:hover {
            color: var(--brand);
        }

        .page-heading {
            margin-top: 1.75rem;
            margin-bottom: 1.5rem;
        }

        .page-heading .eyebrow {
            margin-bottom: .5rem;
            color: var(--brand);
            font-size: .75rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        .page-heading h1 {
            margin-bottom: .55rem;
            font-size: clamp(1.8rem, 5vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -.045em;
        }

        .page-heading p:last-child {
            margin-bottom: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .category-card {
            overflow: hidden;
            border: 1px solid var(--line);
            border-radius: 1.25rem;
            background: #fff;
            box-shadow: 0 1.25rem 3.5rem rgb(48 38 75 / 8%);
        }

        .category-card-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid #f0edf8;
            background: linear-gradient(135deg, #fff, #fcfbff);
        }

        .category-card-header h2 {
            margin: 0;
            font-size: 1rem;
            font-weight: 750;
        }

        .category-card-body {
            padding: clamp(1.25rem, 5vw, 2rem) clamp(1.25rem, 5vw, 1.75rem);
        }

        .form-label {
            margin-bottom: .55rem;
            color: var(--ink);
            font-size: .9rem;
            font-weight: 700;
        }

        .form-control,
        .form-select {
            min-height: 3rem;
            border-color: #ded8ef;
            border-radius: .75rem;
            color: var(--ink);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #9c83f3;
            box-shadow: 0 0 0 .25rem rgb(112 71 235 / 13%);
        }

        .form-text {
            color: var(--muted);
            line-height: 1.6;
        }

        .field-icon {
            display: inline-grid;
            width: 2rem;
            height: 2rem;
            margin-right: .4rem;
            place-items: center;
            border-radius: .65rem;
            background: #f1edff;
            color: var(--brand);
            font-size: .95rem;
        }

        .btn-primary {
            --bs-btn-bg: var(--brand);
            --bs-btn-border-color: var(--brand);
            --bs-btn-hover-bg: var(--brand-dark);
            --bs-btn-hover-border-color: var(--brand-dark);
            --bs-btn-active-bg: var(--brand-dark);
            --bs-btn-active-border-color: var(--brand-dark);
            --bs-btn-focus-shadow-rgb: 112, 71, 235;
            border-radius: .75rem;
            font-weight: 700;
        }

        .btn-light {
            border: 1px solid var(--line);
            border-radius: .75rem;
            color: #655b7d;
            font-weight: 700;
        }

        .btn-light:hover {
            border-color: #d8d0eb;
            background: #f8f6ff;
            color: var(--brand-dark);
        }

        @media (max-width: 575.98px) {
            .category-card-header {
                padding: 1.2rem 1.25rem;
            }

            .form-actions .btn {
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <span class="brand-mark" aria-hidden="true">F</span>
                FreelanceHub
            </a>
            <a class="btn btn-outline-secondary btn-sm rounded-3 fw-semibold" href="{{ route('categories.index') }}">
                Kembali ke kategori
            </a>
        </div>
    </nav>

    <main class="page-content">
        <a class="breadcrumb-link" href="{{ route('categories.index') }}">← Kembali ke daftar kategori</a>

        <header class="page-heading">
            <p class="eyebrow">Pengelolaan marketplace</p>
            <h1>{{ $heading }}</h1>
            <p>Buat kategori utama baru atau tambahkan subkategori agar layanan lebih mudah ditemukan.</p>
        </header>

        @if ($errors->any())
            <div class="alert alert-danger rounded-4 border-0 shadow-sm mb-4" role="alert">
                <h2 class="h6 fw-bold mb-2">Data belum dapat disimpan</h2>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="category-card">
            <div class="category-card-header">
                <h2>Informasi kategori</h2>
            </div>
            <div class="category-card-body">
                <form action="{{ $formAction }}" method="POST">
                    @csrf
                    @if ($formMethod !== 'POST')
                        @method($formMethod)
                    @endif

                    <div class="mb-4">
                        <label class="form-label" for="category_name">
                            <span class="field-icon" aria-hidden="true">✦</span>Nama kategori
                        </label>
                        <input
                            class="form-control @error('category_name') is-invalid @enderror"
                            id="category_name"
                            name="category_name"
                            type="text"
                            value="{{ old('category_name', $category?->category_name) }}"
                            placeholder="Contoh: Desain Grafis"
                            maxlength="255"
                            required
                            autofocus
                            aria-describedby="category-name-help"
                        >
                        <div class="form-text" id="category-name-help">Gunakan nama yang singkat dan mudah dikenali.</div>
                        @error('category_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label" for="parent_category_id">
                            <span class="field-icon" aria-hidden="true">▦</span>Kategori utama
                        </label>
                        <select
                            class="form-select @error('parent_category_id') is-invalid @enderror"
                            id="parent_category_id"
                            name="parent_category_id"
                            aria-describedby="parent-category-help"
                        >
                            <option value="">Jadikan kategori utama</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option
                                    value="{{ $parentCategory->id }}"
                                    @selected((string) old('parent_category_id', $category?->parent_category_id) === (string) $parentCategory->id)
                                >
                                    {{ $parentCategory->category_name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text" id="parent-category-help">
                            Pilih kategori utama untuk membuat subkategori. Biarkan kosong jika ini kategori utama.
                        </div>
                        @error('parent_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions d-flex flex-column flex-sm-row gap-2 pt-2">
                        <button class="btn btn-primary px-4 py-2" type="submit">
                            Simpan kategori
                        </button>
                        <a class="btn btn-light px-4 py-2" href="{{ route('categories.index') }}">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>
