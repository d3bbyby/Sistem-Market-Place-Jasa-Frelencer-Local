
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyek Client - FreelanceHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #F2FAF9;
            color: #183B3A;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1000px;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .request-card {
            background: white;
            border: 1px solid #D8EAE7;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 20px;
        }

        .client-info {
            color: #72918D;
            font-size: 14px;
        }

        .budget {
            color: #0E756D;
            font-weight: bold;
        }

        .proposal-box {
            background: #F7FBFA;
            border: 1px solid #D8EAE7;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .btn-green {
            background: #0E756D;
            color: white;
            border: none;
        }

        .btn-green:hover {
            background: #095A55;
            color: white;
        }

        .section-label {
            font-weight: bold;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Temukan Proyek</h2>
            <p class="text-secondary">
                Temukan kebutuhan client dan kirimkan proposal terbaikmu.
            </p>
        </div>

        <a href="{{ route('freelancer.dashboard') }}"
           class="btn btn-outline-secondary">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            Ada data proposal yang belum sesuai. Periksa kembali formulir.
        </div>
    @endif

    @forelse($serviceRequests as $item)

        <div class="request-card">

            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h5 class="fw-bold mb-2">{{ $item->title }}</h5>

                    <p class="client-info mb-3">
                        Diposting oleh {{ $item->client->name ?? 'Client' }}
                    </p>
                </div>

                <span class="badge bg-success">Terbuka</span>
            </div>

            <p>{{ $item->description }}</p>

            <div class="row mt-3">
                <div class="col-md-4 mb-2">
                    <small class="text-secondary">Kategori</small>
                    <div class="fw-semibold">
                        {{ $item->category ?? 'Tidak ditentukan' }}
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <small class="text-secondary">Anggaran Client</small>
                    <div class="budget">
                        @if($item->budget)
                            Rp{{ number_format((float) $item->budget, 0, ',', '.') }}
                        @else
                            Belum ditentukan
                        @endif
                    </div>
                </div>

                <div class="col-md-4 mb-2">
                    <small class="text-secondary">Deadline</small>
                    <div class="fw-semibold">
                        {{ $item->deadline ? $item->deadline->format('d-m-Y') : 'Tidak ditentukan' }}
                    </div>
                </div>
            </div>

            <div class="proposal-box">

                <h6 class="fw-bold mb-3">Kirim Proposal Penawaran</h6>

                <form action="{{ route('freelancer.service-requests.apply', $item) }}"
                      method="POST">

                    @csrf

                    <div class="mb-3">
                        <label class="section-label">Pesan Penawaran</label>

                        <textarea name="message"
                                  class="form-control"
                                  rows="4"
                                  required
                                  maxlength="1000"
                                  placeholder="Jelaskan kemampuan dan alasan kamu cocok mengerjakan proyek ini...">{{ old('message') }}</textarea>

                        @error('message')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="section-label">Harga Penawaran (Rp)</label>

                            <input type="number"
                                   name="price"
                                   class="form-control"
                                   min="1"
                                   step="1000"
                                   value="{{ old('price') }}"
                                   placeholder="Contoh: 500000"
                                   required>

                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="section-label">Estimasi Pengerjaan</label>

                            <input type="text"
                                   name="duration"
                                   class="form-control"
                                   value="{{ old('duration') }}"
                                   maxlength="100"
                                   placeholder="Contoh: 5 hari"
                                   required>

                            @error('duration')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <button type="submit" class="btn btn-green w-100">
                        Kirim Proposal
                    </button>

                </form>

            </div>

        </div>

    @empty

        <div class="request-card text-center py-5">
            <h5>Belum Ada Proyek</h5>
            <p class="text-secondary mb-0">
                Saat ini belum ada kebutuhan jasa dari client.
            </p>
        </div>

    @endforelse

    <div class="mt-4">
        {{ $serviceRequests->links() }}
    </div>

</div>

</body>
</html>
