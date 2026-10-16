<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jasa</title>
</head>
<body>

    <h2>Detail Jasa</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h3>{{ $service->title }}</h3>

    <p>
        Nama Freelancer:
        {{ $service->freelancer->name ?? 'Belum tersedia' }}
    </p>

    <p>
        Deskripsi:
        {{ $service->description }}
    </p>

    <p>
        Harga:
        Rp{{ number_format($service->price, 0, ',', '.') }}
    </p>

    <form
        action="{{ route('client.orders.store', $service->id) }}"
        method="POST"
    >
        @csrf

        <button type="submit">Pesan Jasa</button>
    </form>

    <br>

    <a href="{{ url('/client/jasa') }}">
        Kembali ke daftar jasa
    </a>

</body>
</html>