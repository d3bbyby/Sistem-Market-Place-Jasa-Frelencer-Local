<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service->title }} - FreelanceHub</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #FAF9FF; color: #30264B; }
        .navbar { background: #7047EB; color: white; padding: 18px 6%; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { margin: 0; }
        .navbar a { color: white; text-decoration: none; }
        .container { width: 90%; max-width: 900px; margin: 40px auto; }
        .card { background: white; border: 1px solid #E7E1F4; border-radius: 15px; padding: 30px; box-shadow: 0 4px 16px rgba(80, 48, 181, .06); }
        .eyebrow { color: #7047EB; font-weight: bold; }
        h1 { margin: 10px 0; }
        .muted { color: #837B99; }
        .price { color: #7047EB; font-size: 24px; font-weight: bold; margin: 20px 0; }
        .description { white-space: pre-line; line-height: 1.7; }
        .button { display: inline-block; background: #7047EB; border: 0; color: white; padding: 12px 18px; border-radius: 8px; text-decoration: none; font-size: 15px; cursor: pointer; }
        .button:hover { background: #5030B5; }
        .back { display: inline-block; margin-top: 20px; color: #7047EB; text-decoration: none; }
        .alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 18px; background: #FFF1DC; color: #805515; }
        @media (max-width: 600px) { .card { padding: 22px; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>FreelanceHub</h2>
        <a href="{{ route('client.orders.index') }}">Pesanan Saya</a>
    </nav>

    <main class="container">
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <section class="card">
            <div class="eyebrow">{{ $service->category?->category_name ?? 'Jasa Freelance' }}</div>
            <h1>{{ $service->title }}</h1>
            <p class="muted">Ditawarkan oleh {{ $service->freelancer->name }}</p>
            <p class="price">Rp{{ number_format((float) $service->price, 0, ',', '.') }}</p>
            <div class="description">{{ $service->description }}</div>

            <form method="POST" action="{{ route('client.orders.store', $service) }}" style="margin-top: 25px;">
                @csrf
                <button class="button" type="submit">Pesan Jasa</button>
            </form>

            <a class="back" href="/client/jasa">Kembali ke daftar jasa</a>
        </section>
    </main>
</body>
</html>
