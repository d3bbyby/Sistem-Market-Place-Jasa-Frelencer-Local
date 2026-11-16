
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Posting - FreelanceHub</title>

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

        .form-card {
            background: white;
            border-radius: 12px;
            padding: 28px;
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

    <div class="mb-4">
        <h3 class="page-title">Buat Posting Kebutuhan Jasa</h3>
        <p class="text-muted">
            Jelaskan jasa yang sedang kamu butuhkan agar freelancer dapat mengajukan diri.
        </p>
    </div>

    <div class="form-card">

        <form action="{{ route('client.service-requests.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Judul Kebutuhan Jasa</label>
                <input
                    type="text"
                    name="title"
                    class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Membutuhkan jasa desain logo"
                    required
                >

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi Kebutuhan</label>
                <textarea
                    name="description"
                    rows="5"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Jelaskan detail jasa yang kamu butuhkan..."
                    required
                >{{ old('description') }}</textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Kategori Jasa</label>
                <input
                    type="text"
                    name="category"
                    class="form-control @error('category') is-invalid @enderror"
                    value="{{ old('category') }}"
                    placeholder="Contoh: Desain Grafis"
                >

                @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Anggaran (Rp)</label>
                <input
                    type="number"
                    name="budget"
                    class="form-control @error('budget') is-invalid @enderror"
                    value="{{ old('budget') }}"
                    min="0"
                    placeholder="Contoh: 500000"
                >

                @error('budget')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Batas Waktu</label>
                <input
                    type="date"
                    name="deadline"
                    class="form-control @error('deadline') is-invalid @enderror"
                    value="{{ old('deadline') }}"
                    min="{{ date('Y-m-d') }}"
                >

                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn btn-purple">
                    Simpan Posting
                </button>

                <a href="{{ route('client.service-requests.index') }}"
                   class="btn btn-outline-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>

</div>

</body>
</html>
