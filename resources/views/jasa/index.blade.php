<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasa Saya - FreelanceHub</title>
    <style>
        :root { --ink: #18212b; --muted: #718096; --line: #e6e9ed; --paper: #fff; --accent: #d97745; --accent-dark: #a94d25; --bg: #f4f6f4; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: radial-gradient(circle at 90% 0%, #fce7d9 0, transparent 30%), var(--bg); font-family: Arial, sans-serif; }
        .app { display: flex; min-height: 100vh; }
        .sidebar { width: 238px; padding: 28px 18px; background: #17232b; color: #fff; }
        .brand { padding: 0 14px 30px; font-size: 21px; font-weight: 700; letter-spacing: .4px; }
        .eyebrow { padding: 0 14px 10px; color: #8fa0a8; font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; }
        .nav a { display: block; padding: 12px 14px; margin: 4px 0; color: #cbd5d9; border-radius: 8px; text-decoration: none; font-size: 14px; }
        .nav a:hover, .nav a.active { background: #30424a; color: #fff; }
        .main { flex: 1; min-width: 0; padding: 30px clamp(22px, 5vw, 70px); }
        .topbar, .heading, .actions, .card-footer { display: flex; align-items: center; justify-content: space-between; gap: 16px; }
        .topbar { margin-bottom: 42px; color: var(--muted); font-size: 14px; }
        .profile { display: flex; align-items: center; gap: 10px; color: var(--ink); font-weight: 700; }
        .avatar { display: grid; place-items: center; width: 36px; height: 36px; border-radius: 50%; background: #f1c6ad; color: #71391f; }
        h1 { margin: 0; font-size: clamp(28px, 4vw, 42px); letter-spacing: -1px; }
        .subtitle { margin: 9px 0 0; color: var(--muted); }
        .button { display: inline-block; border: 0; border-radius: 7px; padding: 12px 16px; color: #fff; background: var(--accent-dark); text-decoration: none; font-size: 14px; cursor: pointer; }
        .button:hover { background: #873b1b; }
        .stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 14px; margin: 30px 0; }
        .stat, .card, .empty { background: var(--paper); border: 1px solid var(--line); border-radius: 10px; box-shadow: 0 8px 24px rgba(24, 33, 43, .04); }
        .stat { padding: 18px 20px; }
        .stat strong { display: block; font-size: 27px; }
        .stat span { color: var(--muted); font-size: 13px; }
        .toolbar { margin-bottom: 18px; color: var(--muted); font-size: 13px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(270px, 1fr)); gap: 18px; }
        .card { padding: 22px; }
        .card-mark { width: 42px; height: 42px; display: grid; place-items: center; border-radius: 9px; background: #fce3d5; color: var(--accent-dark); font-weight: 700; }
        .card h2 { margin: 18px 0 8px; font-size: 19px; }
        .card p { margin: 8px 0; color: var(--muted); line-height: 1.5; font-size: 14px; }
        .price { color: var(--accent-dark) !important; font-size: 17px !important; font-weight: 700; }
        .category { display: inline-block; padding: 5px 8px; border-radius: 99px; background: #eef4ef; color: #477054; font-size: 11px; }
        .card-footer { margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--line); }
        .edit { color: var(--accent-dark); text-decoration: none; font-size: 13px; font-weight: 700; }
        .delete { border: 0; background: none; color: #b42318; cursor: pointer; font-size: 13px; }
        .empty { padding: 48px 24px; text-align: center; }
        .empty-mark { margin: 0 auto 14px; width: 52px; height: 52px; display: grid; place-items: center; border-radius: 50%; background: #fce3d5; color: var(--accent-dark); font-size: 24px; }
        .empty p { color: var(--muted); }
        .alert { margin-bottom: 18px; padding: 13px 16px; border-radius: 7px; background: #dff4e6; color: #21613a; }
        @media (max-width: 760px) { .sidebar { display: none; } .main { padding: 22px 16px; } .topbar { margin-bottom: 30px; } .stats { grid-template-columns: 1fr; } .heading { align-items: flex-start; flex-direction: column; } }
    </style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="brand">FreelanceHub</div>
        <div class="eyebrow">Workspace</div>
        <nav class="nav">
            <a href="/freelancer/dashboard">Dashboard</a>
            <a class="active" href="{{ route('jasa.index') }}">Jasa Saya</a>
            <a href="{{ route('portfolios.index') }}">Portofolio</a>
            <a href="{{ route('categories.index') }}">Kategori</a>
            <a href="/freelancer/profil">Profil Saya</a>
        </nav>
    </aside>
    <main class="main">
        <div class="topbar"><span>Workspace / Jasa Saya</span><div class="profile"><span class="avatar">F</span> Freelancer</div></div>
        @if (session('success')) <div class="alert">{{ session('success') }}</div> @endif
        <div class="heading"><div><h1>Jasa Saya</h1><p class="subtitle">Atur layanan yang ingin kamu tawarkan kepada klien.</p></div><a class="button" href="{{ route('jasa.create') }}">+ Tambah Jasa</a></div>
        <div class="stats"><div class="stat"><strong>{{ $jasa->count() }}</strong><span>Total jasa aktif</span></div><div class="stat"><strong>{{ $jasa->pluck('category_id')->unique()->count() }}</strong><span>Kategori digunakan</span></div><div class="stat"><strong>{{ $jasa->pluck('freelancer_id')->unique()->count() }}</strong><span>Freelancer terdaftar</span></div></div>
        <div class="toolbar">{{ $jasa->count() }} layanan ditemukan</div>
        <div class="grid">
            @forelse ($jasa as $item)
                <article class="card"><div class="card-mark">J</div><h2>{{ $item->title }}</h2><span class="category">{{ $item->category->category_name }}</span><p>{{ Str::limit($item->description, 105) }}</p><p><strong>Freelancer:</strong> {{ $item->freelancer->name }}</p><p class="price">Rp {{ number_format($item->price, 0, ',', '.') }}</p><div class="card-footer"><a class="edit" href="{{ route('jasa.edit', $item) }}">Edit jasa</a><form action="{{ route('jasa.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus jasa ini?')">@csrf @method('DELETE')<button class="delete" type="submit">Hapus</button></form></div></article>
            @empty
                <div class="empty" style="grid-column: 1 / -1"><div class="empty-mark">+</div><h2>Belum ada jasa</h2><p>Mulai buat layanan pertamamu agar bisa ditemukan klien.</p><a class="button" href="{{ route('jasa.create') }}">Buat Jasa Pertama</a></div>
            @endforelse
        </div>
    </main>
</div>
</body>
</html>
