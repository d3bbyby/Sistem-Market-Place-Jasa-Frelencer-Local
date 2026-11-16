
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posting Kebutuhan Jasa Saya - FreelanceHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f6ff;
            font-family: Arial, sans-serif;
        }

        .page-title {
            color: #49377c;
            font-weight: bold;
        }

        .content-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
        }

        .btn-purple {
            background: #7054a5;
            color: white;
            border: none;
        }

        .btn-purple:hover {
            background: #594080;
            color: white;
        }
    </style>
</head>

<body>

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h3 class="page-title">Posting Kebutuhan Jasa Saya</h3>
            <p class="text-muted mb-0">
                Kelola kebutuhan jasa yang sudah kamu posting.
            </p>
        </div>

        <a href="{{ route('client.service-requests.create') }}" class="btn btn-purple">
            + Buat Posting
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @forelse ($serviceRequests as $serviceRequest)

        <div class="content-card mb-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="fw-bold mb-0">
                    {{ $serviceRequest->title }}
                </h5>

                <span class="badge bg-{{ $serviceRequest->status === 'open' ? 'success' : 'secondary' }}">
                    {{ $serviceRequest->status === 'open' ? 'Dibuka' : 'Ditutup' }}
                </span>
            </div>

            <p class="text-muted mt-3 mb-3">
                {{ $serviceRequest->description }}
            </p>

            <p class="mb-1">
                <strong>Kategori:</strong>
                {{ $serviceRequest->category ?? '-' }}
            </p>

            <p class="mb-1">
                <strong>Anggaran:</strong>
                {{ $serviceRequest->budget ? 'Rp ' . number_format((float) $serviceRequest->budget, 0, ',', '.') : 'Belum ditentukan' }}
            </p>

            <p class="mb-3">
                <strong>Batas waktu:</strong>
                {{ $serviceRequest->deadline ? $serviceRequest->deadline->format('d-m-Y') : '-' }}
            </p>

            <p>
                <strong>Jumlah pengajuan:</strong>
                {{ $serviceRequest->applications_count }}
            </p>

            <div class="d-flex flex-wrap gap-2">

                <a href="{{ route('client.service-requests.applications', $serviceRequest->id) }}"
                   class="btn btn-outline-primary btn-sm">
                    Lihat Pengajuan
                </a>

                <form action="{{ route('client.service-requests.destroy', $serviceRequest->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus posting ini?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        Hapus
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="content-card text-center py-5">
            <h5>Belum Ada Posting</h5>

            <p class="text-muted">
                Kamu belum membuat posting kebutuhan jasa.
            </p>

            <a href="{{ route('client.service-requests.create') }}" class="btn btn-purple">
                Buat Posting Sekarang
            </a>
        </div>

    @endforelse

    <div class="mt-3">
        {{ $serviceRequests->links() }}
    </div>

    <a href="{{ route('client.dashboard') }}" class="btn btn-outline-secondary mt-3">
    Kembali ke Dashboard
</a>
</div>

</body>
</html>
