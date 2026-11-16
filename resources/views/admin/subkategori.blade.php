<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subkategori Jasa - FreelanceHub Admin</title>
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
        .subtitle { margin: 8px 0 0; color: #7A8798; line-height: 1.6; }
        .button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 8px; padding: 11px 15px; background: #C49A45; color: #142B49; font-weight: 700; text-decoration: none; cursor: pointer; }
        .button:hover { background: #A87922; color: white; }
        .button.secondary { border: 1px solid #D9E0E9; background: white; color: #4A5A70; }
        .stats { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; margin-bottom: 20px; }
        .stat, .table-box { border: 1px solid #E1E6EE; border-radius: 14px; background: white; box-shadow: 0 5px 18px rgba(16, 39, 68, .04); }
        .stat { padding: 17px 19px; }
        .stat strong { display: block; color: #142B49; font-size: 25px; }
        .stat span { display: block; margin-top: 5px; color: #7A8798; font-size: 13px; }
        .filter-box { display: grid; grid-template-columns: minmax(220px, 1fr) minmax(210px, .75fr) auto auto; gap: 10px; margin-bottom: 18px; padding: 15px; border: 1px solid #E1E6EE; border-radius: 12px; background: white; }
        .filter-box input, .filter-box select { width: 100%; min-width: 0; border: 1px solid #D9E0E9; border-radius: 8px; padding: 11px 12px; color: #1E2C3D; background: white; }
        .filter-box input:focus, .filter-box select:focus { border-color: #C49A45; outline: 3px solid rgba(196, 154, 69, .16); }
        .table-box { overflow: hidden; }
        .table-heading { display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid #E6EBF2; padding: 16px 20px; }
        .table-heading h2 { margin: 0; font-size: 16px; }
        .count { border-radius: 999px; padding: 6px 10px; background: #F8F0DD; color: #805D17; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 760px; border-collapse: collapse; text-align: left; }
        th { padding: 13px 15px; background: #142B49; color: white; font-size: 12px; text-transform: uppercase; letter-spacing: .4px; }
        td { padding: 14px 15px; border-bottom: 1px solid #E6EBF2; color: #4A5A70; vertical-align: middle; }
        tbody tr:hover { background: #F8FAFC; }
        .subcategory-name { color: #1E2C3D; font-weight: 700; }
        .parent-link, .service-link { color: #805D17; font-weight: 700; text-decoration: none; }
        .parent-link:hover, .service-link:hover { text-decoration: underline; }
        .actions { display: flex; align-items: center; gap: 12px; }
        .edit-link { color: #315A83; font-weight: 700; text-decoration: none; }
        .delete-button { border: 0; padding: 0; background: none; color: #B42318; font: inherit; font-weight: 700; cursor: pointer; }
        .alert { margin-bottom: 14px; border-radius: 8px; padding: 12px 15px; }
        .alert.error { background: #FDE8E7; color: #9F1D16; }
        .empty { padding: 40px 18px; color: #7A8798; text-align: center; }
        .pagination { padding: 16px; color: #4A5A70; }
        .pagination a, .pagination span { display: inline-block; margin: 2px; border: 1px solid #E1E6EE; border-radius: 6px; padding: 7px 10px; background: white; color: #4A5A70; text-decoration: none; }
        @media (max-width: 760px) {
            .navbar, .heading { align-items: flex-start; flex-direction: column; }
            .container { margin-top: 26px; }
            .filter-box { grid-template-columns: 1fr 1fr; }
            .filter-box input { grid-column: 1 / -1; }
        }
        @media (max-width: 480px) {
            .stats, .filter-box { grid-template-columns: 1fr; }
            .filter-box input { grid-column: auto; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="brand" href="{{ route('admin.dashboard') }}">FreelanceHub Admin</a>
        <div class="nav-actions">
            <a class="nav-button" href="{{ route('admin.categories.index') }}">Kategori utama</a>
            <a class="nav-button primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
    </nav>

    <main class="container">
        <header class="heading">
            <div>
                <p class="eyebrow">Pengelolaan marketplace</p>
                <h1>Subkategori Jasa</h1>
                <p class="subtitle">Gunakan subkategori untuk mengelompokkan jasa secara lebih spesifik di bawah kategori utama.</p>
            </div>
            <a class="button" href="{{ route('categories.create') }}">+ Tambah subkategori</a>
        </header>

        @if ($errors->any())
            <div class="alert error" role="alert">{{ $errors->first() }}</div>
        @endif

        <section class="stats" aria-label="Ringkasan subkategori">
            <div class="stat"><strong>{{ $subcategoryCount }}</strong><span>Total subkategori</span></div>
            <div class="stat"><strong>{{ $serviceCount }}</strong><span>Jasa di dalam subkategori</span></div>
        </section>

        <form class="filter-box" method="GET" action="{{ route('admin.subcategories.index') }}">
            <input type="search" name="q" value="{{ $filters['q'] ?? '' }}"
                   placeholder="Cari nama atau slug subkategori" aria-label="Cari nama atau slug subkategori">
            <select name="parent_category_id" aria-label="Filter kategori utama">
                <option value="">Semua kategori utama</option>
                @foreach ($parentCategories as $parent)
                    <option value="{{ $parent->id }}" @selected(($filters['parent_category_id'] ?? '') == $parent->id)>
                        {{ $parent->category_name }}
                    </option>
                @endforeach
            </select>
            <button class="button" type="submit">Cari</button>
            <a class="button secondary" href="{{ route('admin.subcategories.index') }}">Reset</a>
        </form>

        <section class="table-box">
            <div class="table-heading">
                <h2>Daftar subkategori</h2>
                <span class="count">{{ $subcategories->total() }} subkategori</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Subkategori</th>
                            <th>Kategori utama</th>
                            <th>Slug</th>
                            <th>Jasa terkait</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subcategories as $subcategory)
                            <tr>
                                <td class="subcategory-name">{{ $subcategory->category_name }}</td>
                                <td>
                                    @if ($subcategory->parent)
                                        <a class="parent-link" href="{{ route('categories.services', ['category' => $subcategory->parent->slug]) }}">
                                            {{ $subcategory->parent->category_name }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $subcategory->slug }}</td>
                                <td>
                                    <a class="service-link" href="{{ route('categories.services', ['category' => $subcategory->slug]) }}">
                                        {{ $subcategory->services_count }} jasa
                                    </a>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a class="edit-link" href="{{ route('categories.edit', $subcategory) }}">Edit</a>
                                        <form action="{{ route('categories.destroy', $subcategory) }}" method="POST"
                                              onsubmit="return confirm('Hapus subkategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete-button" type="submit">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="empty" colspan="5">
                                    @if (($filters['q'] ?? false) || ($filters['parent_category_id'] ?? false))
                                        Tidak ada subkategori yang cocok dengan filter.
                                    @elseif ($parentCategories->isEmpty())
                                        Buat kategori utama terlebih dahulu sebelum menambahkan subkategori.
                                        <a class="edit-link" href="{{ route('categories.create') }}">Buat kategori utama</a>
                                    @else
                                        Belum ada subkategori. Tambahkan subkategori untuk memperjelas pengelompokan jasa.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($subcategories->hasPages())
                <div class="pagination">{{ $subcategories->links() }}</div>
            @endif
        </section>
    </main>
</body>
</html>
