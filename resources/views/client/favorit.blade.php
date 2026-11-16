
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorit Saya - FreelanceHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f7f5fc;
            color: #333;
        }

        .navbar {
            background: #6c4ab6;
            color: white;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            font-size: 23px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 22px;
        }

        .container {
            width: 86%;
            max-width: 1200px;
            margin: 35px auto;
        }

        .heading {
            margin-bottom: 25px;
        }

        .heading h1 {
            color: #55358f;
            margin-bottom: 8px;
        }

        .section {
            background: white;
            padding: 25px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .section h2 {
            color: #6241a5;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .favorite-card {
            border: 1px solid #eee8f8;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .favorite-card h3 {
            color: #493078;
            margin-bottom: 7px;
        }

        .favorite-card p {
            color: #777;
            font-size: 14px;
        }

        .empty {
            text-align: center;
            color: #888;
            padding: 25px;
        }

        .delete-btn {
            background: #ffe8e8;
            color: #d64545;
            border: none;
            padding: 9px 14px;
            border-radius: 8px;
            cursor: pointer;
        }

        .success {
            background: #e8f8ed;
            color: #287a43;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media(max-width: 650px) {
            .navbar {
                flex-direction: column;
                gap: 12px;
            }

            .container {
                width: 92%;
            }

            .favorite-card {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<nav class="navbar">
    <h2>FreelanceHub</h2>

    <div>
        <a href="{{ route('client.dashboard') }}">Dashboard</a>
        <a href="{{ route('client.profile') }}">Profil</a>
    </div>
</nav>

<div class="container">

    <div class="heading">
        <h1>Favorit Saya ♡</h1>
        <p>Daftar jasa dan freelancer yang kamu simpan.</p>
    </div>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    {{-- JASA FAVORIT --}}
    <div class="section">
        <h2>♡ Jasa Favorit</h2>

        @php
            $serviceFavorites = $favorites->whereNotNull('service_id');
        @endphp

        @forelse($serviceFavorites as $favorite)
            <div class="favorite-card">
                <div>
                    <h3>{{ $favorite->service?->nama_jasa ?? $favorite->service?->name ?? 'Jasa' }}</h3>
                    <p>Jasa yang kamu simpan sebagai favorit.</p>
                </div>

                <form action="{{ route('client.favorit.destroy', $favorite->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" type="submit">Hapus</button>
                </form>
            </div>
        @empty
            <div class="empty">Belum ada jasa favorit.</div>
        @endforelse
    </div>

    {{-- FREELANCER FAVORIT --}}
    <div class="section">
        <h2>♡ Freelancer Favorit</h2>

        @php
            $freelancerFavorites = $favorites->whereNotNull('freelancer_id');
        @endphp

        @forelse($freelancerFavorites as $favorite)
            <div class="favorite-card">
                <div>
                    <h3>{{ $favorite->freelancer?->name ?? 'Freelancer' }}</h3>
                    <p>Freelancer yang kamu simpan sebagai favorit.</p>
                </div>

                <form action="{{ route('client.favorit.destroy', $favorite->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="delete-btn" type="submit">Hapus</button>
                </form>
            </div>
        @empty
            <div class="empty">Belum ada freelancer favorit.</div>
        @endforelse
    </div>

</div>

</body>
</html>
