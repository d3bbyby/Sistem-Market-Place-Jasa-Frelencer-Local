<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Jasa - FreelanceHub</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #F4F6FA; color: #1E2C3D; font-family: Arial, sans-serif; }
        .navbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 18px 6%; background: #142B49; color: white; }
        .brand { color: #E5C477; font-size: 21px; font-weight: 800; text-decoration: none; }
        .nav-actions { display: flex; flex-wrap: wrap; gap: 10px; }
        .nav-button { display: inline-flex; align-items: center; border: 1px solid #D9C99F; border-radius: 8px; padding: 9px 13px; color: white; font-size: 14px; font-weight: 700; text-decoration: none; }
        .nav-button:hover { background: #223E60; }
        .nav-button.primary { border-color: #C49A45; background: #C49A45; color: #142B49; }
        .container { width: min(94%, 1280px); margin: 38px auto; }
        .heading { display: flex; align-items: flex-end; justify-content: space-between; gap: 18px; margin-bottom: 22px; }
        .eyebrow { margin: 0 0 8px; color: #A87922; font-size: 12px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(26px, 4vw, 36px); }
        .subtitle { margin: 8px 0 0; color: #7A8798; }
        .filter-box, .table-box { border: 1px solid #E1E6EE; border-radius: 14px; background: white; box-shadow: 0 5px 18px rgba(16, 39, 68, .04); }
        .filter-box { display: grid; grid-template-columns: minmax(200px, 1fr) minmax(200px, .7fr) auto auto; gap: 10px; margin-bottom: 18px; padding: 16px; }
        .filter-box input, .filter-box select { width: 100%; min-width: 0; border: 1px solid #D9E0E9; border-radius: 8px; padding: 11px 12px; color: #1E2C3D; background: white; }
        .filter-box input:focus, .filter-box select:focus { border-color: #C49A45; outline: 3px solid rgba(196, 154, 69, .16); }
        .button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 8px; padding: 11px 15px; background: #C49A45; color: #142B49; font-weight: 700; text-decoration: none; cursor: pointer; }
        .button:hover { background: #A87922; color: white; }
        .button.secondary { border: 1px solid #D9E0E9; background: white; color: #4A5A70; }
        .table-box { overflow: hidden; }
        .table-heading { display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid #E6EBF2; padding: 16px 20px; }
        .table-heading h2 { margin: 0; font-size: 16px; }
        .count { border-radius: 999px; padding: 6px 10px; background: #F8F0DD; color: #805D17; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; min-width: 850px; border-collapse: collapse; text-align: left; }
        th { padding: 13px 15px; background: #142B49; color: white; font-size: 12px; text-transform: uppercase; letter-spacing: .4px; }
        td { padding: 15px; border-bottom: 1px solid #E6EBF2; color: #4A5A70; vertical-align: top; }
        tbody tr:hover { background: #F8FAFC; }
        .service-title { display: block; color: #1E2C3D; font-weight: 700; text-decoration: none; }
        .service-title:hover, .category-link:hover { color: #A87922; text-decoration: underline; }
        .description, .muted { display: block; margin-top: 5px; color: #7A8798; font-size: 12px; line-height: 1.5; }
        .category-link { color: #805D17; font-weight: 700; text-decoration: none; }
        .empty { padding: 40px 18px; color: #7A8798; text-align: center; }
        .alert { margin-bottom: 14px; border-radius: 8px; padding: 12px 15px; background: #FDE8E7; color: #9F1D16; }
        .pagination { padding: 16px; color: #4A5A70; }
        .pagination a, .pagination span { display: inline-block; margin: 2px; border: 1px solid #E1E6EE; border-radius: 6px; padding: 7px 10px; background: white; color: #4A5A70; text-decoration: none; }
        @media (max-width: 760px) {
            .navbar { align-items: flex-start; flex-direction: column; padding: 17px 5%; }
            .heading { align-items: flex-start; flex-direction: column; }
            .filter-box { grid-template-columns: 1fr 1fr; }
            .filter-box input[type="search"] { grid-column: 1 / -1; }
        }
        @media (max-width: 480px) {
            .filter-box { grid-template-columns: 1fr; }
            .filter-box input[type="search"] { grid-column: auto; }
            .container { margin-top: 26px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a class="brand" href="{{ route('admin.dashboard') }}">FreelanceHub Admin</a>
        <div class="nav-actions">
            <a class="nav-button" href="{{ route('admin.categories.index') }}">Kelola kategori</a>
            <a class="nav-button primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </div>
    </nav>

    <main class="container">
        <header class="heading">
            <div>
                <p class="eyebrow">Pengelolaan marketplace</p>
                <h1>Semua Jasa</h1>
                <p class="subtitle">Tinjau jasa yang ditawarkan freelancer beserta kategori dan jumlah pesanannya.</p>
            </div>
        </header>

        @if ($errors->any())
            <div class="alert" role="alert">{{ $errors->first() }}</div>
        @endif

        <form class="filter-box" method="GET" action="{{ route('admin.jasa.index') }}">
            <input type="search" name="q" value="{{ $filters['q'] ?? '' }}"
                   placeholder="Cari jasa atau freelancer" aria-label="Cari jasa atau freelancer">
            <select name="category_id" aria-label="Filter kategori">
                <option value="">Semua kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? '') == $category->id)>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
            <button class="button" type="submit">Cari</button>
            <a class="button secondary" href="{{ route('admin.jasa.index') }}">Reset</a>
        </form>

        <section class="table-box">
            <div class="table-heading">
                <h2>Daftar jasa</h2>
                <span class="count">{{ $services->total() }} jasa</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Jasa</th>
                            <th>Freelancer</th>
                            <th>Kategori</th>
                            <th>Harga mulai</th>
                            <th>Pesanan</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td>
                                    <a class="service-title" href="{{ route('jasa.show', $service) }}">{{ $service->title }}</a>
                                    <span class="description">{{ Str::limit($service->description, 110) }}</span>
                                </td>
                                <td>
                                    {{ $service->freelancer?->name ?? 'Freelancer tidak tersedia' }}
                                    @if ($service->freelancer?->email)
                                        <span class="muted">{{ $service->freelancer->email }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($service->category)
                                        <a class="category-link" href="{{ route('categories.services', ['category' => $service->category->slug]) }}">
                                            {{ $service->category->category_name }}
                                        </a>
                                    @else
                                        <span class="muted">Tanpa kategori</span>
                                    @endif
                                </td>
                                <td>Rp{{ number_format((float) $service->price, 0, ',', '.') }}</td>
                                <td>{{ $service->orders_count }}</td>
                                <td>{{ $service->created_at?->format('d M Y') ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="empty" colspan="6">Belum ada jasa yang sesuai dengan pencarian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($services->hasPages())
                <div class="pagination">{{ $services->links() }}</div>
            @endif
        </section>
    </main>
</body>
</html>
