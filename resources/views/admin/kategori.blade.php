<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Jasa - FreelanceHub Admin</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #F4F6FA; color: #1E2C3D; font-family: Arial, sans-serif; }
        .navbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 18px 6%; background: #142B49; color: white; }
        .brand { color: #E5C477; font-size: 21px; font-weight: 800; text-decoration: none; }
        .nav-actions { display: flex; flex-wrap: wrap; gap: 10px; }
        .nav-button { display: inline-flex; align-items: center; border: 1px solid #D9C99F; border-radius: 8px; padding: 9px 13px; color: white; font-size: 14px; font-weight: 700; text-decoration: none; }
        .nav-button:hover { background: #223E60; }
        .nav-button.primary { border-color: #C49A45; background: #C49A45; color: #142B49; }
        .container { width: min(94%, 1180px); margin: 38px auto; }
        .heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 22px; }
        .eyebrow { margin: 0 0 8px; color: #A87922; font-size: 12px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(26px, 4vw, 36px); }
        .subtitle { margin: 8px 0 0; color: #7A8798; }
        .button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 8px; padding: 11px 15px; background: #C49A45; color: #142B49; font-weight: 700; text-decoration: none; cursor: pointer; }
        .button:hover { background: #A87922; color: white; }
        .button.secondary { border: 1px solid #D9E0E9; background: white; color: #4A5A70; }
        .stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; margin-bottom: 20px; }
        .stat, .table-box { border: 1px solid #E1E6EE; border-radius: 14px; background: white; box-shadow: 0 5px 18px rgba(16, 39, 68, .04); }
        .stat { padding: 17px 19px; }
        .stat strong { display: block; color: #142B49; font-size: 25px; }
        .stat span { display: block; margin-top: 5px; color: #7A8798; font-size: 13px; }
        .filter-box { display: flex; gap: 10px; margin-bottom: 18px; padding: 15px; border: 1px solid #E1E6EE; border-radius: 12px; background: white; }
        .filter-box input { flex: 1; min-width: 0; border: 1px solid #D9E0E9; border-radius: 8px; padding: 11px 12px; color: #1E2C3D; }
        .filter-box input:focus { border-color: #C49A45; outline: 3px solid rgba(196, 154, 69, .16); }
        .table-box { overflow: hidden; }
        .table-heading { display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid #E6EBF2; padding: 16px 20px; }
        .table-heading h2 { margin: 0; font-size: 16px; }
        .count { border-radius: 999px; padding: 6px 10px; background: #F8F0DD; color: #805D17; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 760px; border-collapse: collapse; text-align: left; }
        th { padding: 13px 15px; background: #142B49; color: white; font-size: 12px; text-transform: uppercase; letter-spacing: .4px; }
        td { padding: 14px 15px; border-bottom: 1px solid #E6EBF2; color: #4A5A70; vertical-align: middle; }
        tbody tr:hover { background: #F8FAFC; }
        .category-name { color: #1E2C3D; font-weight: 700; }
        .level { display: inline-block; margin-left: 7px; border-radius: 999px; padding: 4px 8px; background: #F8F0DD; color: #805D17; font-size: 11px; font-weight: 700; }
        .child-row { background: #FAFBFD; }
        .child-name { padding-left: 36px; font-weight: 600; }
        .service-link { color: #805D17; font-weight: 700; text-decoration: none; }
        .service-link:hover { text-decoration: underline; }
        .muted { color: #7A8798; font-size: 12px; font-weight: 400; }
        .actions { display: flex; align-items: center; gap: 12px; }
        .edit-link { color: #315A83; font-weight: 700; text-decoration: none; }
        .delete-button { border: 0; padding: 0; background: none; color: #B42318; font: inherit; font-weight: 700; cursor: pointer; }
        .alert { margin-bottom: 14px; border-radius: 8px; padding: 12px 15px; }
        .alert.success { background: #EAF8EF; color: #28643A; }
        .alert.error { background: #FDE8E7; color: #9F1D16; }
        .empty { padding: 40px 18px; color: #7A8798; text-align: center; }
        @media (max-width: 680px) {
            .navbar, .heading { align-items: flex-start; flex-direction: column; }
            .container { margin-top: 26px; }
            .stats { grid-template-columns: 1fr; }
            .filter-box { flex-wrap: wrap; }
            .filter-box input { flex-basis: 100%; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="brand" href="{{ route('admin.dashboard') }}">FreelanceHub Admin</a>
        <div class="nav-actions">
            <a class="nav-button" href="{{ route('admin.subcategories.index') }}">Kelola subkategori</a>
            <a class="nav-button" href="{{ route('admin.jasa.index') }}">Kelola jasa</a>
            <a class="nav-button primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
    </nav>

    <main class="container">
        <header class="heading">
            <div>
                <p class="eyebrow">Pengelolaan marketplace</p>
                <h1>Kategori Jasa</h1>
                <p class="subtitle">Kelola kategori dan subkategori yang digunakan untuk mengelompokkan jasa.</p>
            </div>
            <a class="button" href="{{ route('categories.create') }}">+ Tambah kategori</a>
        </header>

        @if (session('success'))
            <div class="alert success" role="status">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert error" role="alert">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert error" role="alert">{{ $errors->first() }}</div>
        @endif

        <section class="stats" aria-label="Ringkasan kategori jasa">
            <div class="stat"><strong>{{ $mainCategoryCount }}</strong><span>Kategori utama</span></div>
            <div class="stat"><strong>{{ $subcategoryCount }}</strong><span>Subkategori</span></div>
            <div class="stat"><strong>{{ $serviceCount }}</strong><span>Total jasa terdaftar</span></div>
        </section>

        <form class="filter-box" method="GET" action="{{ route('admin.categories.index') }}">
            <input type="search" name="q" value="{{ $filters['q'] ?? '' }}"
                   placeholder="Cari nama atau slug kategori" aria-label="Cari nama atau slug kategori">
            <button class="button" type="submit">Cari kategori</button>
            <a class="button secondary" href="{{ route('admin.categories.index') }}">Reset</a>
        </form>

        <section class="table-box">
            <div class="table-heading">
                <h2>Daftar kategori dan subkategori</h2>
                <span class="count">{{ $categories->sum(fn ($category) => 1 + $category->children->count()) }} kategori</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Slug</th>
                            <th>Jasa terkait</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td><span class="category-name">{{ $category->category_name }}</span><span class="level">Utama</span></td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <a class="service-link" href="{{ route('categories.services', ['category' => $category->slug]) }}">
                                        {{ $category->services_count + $category->children->sum('services_count') }} jasa
                                        <span class="muted">(termasuk subkategori)</span>
                                    </a>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a class="edit-link" href="{{ route('categories.edit', $category) }}">Edit</a>
                                        <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                              onsubmit="return confirm('Hapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-button" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @foreach ($category->children as $child)
                                <tr class="child-row">
                                    <td class="child-name">↳ {{ $child->category_name }} <span class="level">Subkategori</span></td>
                                    <td>{{ $child->slug }}</td>
                                    <td>
                                        <a class="service-link" href="{{ route('categories.services', ['category' => $child->slug]) }}">
                                            {{ $child->services_count }} jasa
                                        </a>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a class="edit-link" href="{{ route('categories.edit', $child) }}">Edit</a>
                                            <form action="{{ route('categories.destroy', $child) }}" method="POST"
                                                  onsubmit="return confirm('Hapus subkategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="delete-button" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td class="empty" colspan="4">
                                    @if ($filters['q'] ?? false)
                                        Tidak ada kategori yang cocok dengan pencarian.
                                    @else
                                        Belum ada kategori. Tambahkan kategori pertama untuk mengelompokkan jasa.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
