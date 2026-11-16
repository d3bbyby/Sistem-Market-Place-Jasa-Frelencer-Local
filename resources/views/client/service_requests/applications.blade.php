
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Freelancer - FreelanceHub</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f7f6ff;
            font-family: Arial, sans-serif;
            color: #30294a;
        }

        .container {
            max-width: 1000px;
        }

        .page-title {
            color: #49377c;
            font-weight: bold;
        }

        .content-card {
            background: white;
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px rgba(0,0,0,.05);
        }

        .profile-photo {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            background: #eee;
        }

        .profile-initial {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #7054a5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            font-weight: bold;
        }

        .info-box {
            background: #f8f7fc;
            border-radius: 10px;
            padding: 14px;
            height: 100%;
        }

        .info-label {
            color: #777;
            font-size: 13px;
        }

        .info-value {
            font-weight: bold;
            margin-top: 5px;
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

    <h3 class="page-title mb-2">Proposal Freelancer</h3>

    <p class="text-muted">
        Daftar freelancer yang menawarkan jasa untuk proyek:
        <strong>{{ $serviceRequest->title }}</strong>
    </p>

    <a href="{{ route('client.service-requests.index') }}"
       class="btn btn-secondary btn-sm mb-4">
        Kembali
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @forelse($applications as $application)

        <div class="content-card">

            {{-- PROFIL FREELANCER --}}
            <div class="d-flex align-items-center gap-3 mb-4">

                @if($application->freelancer->profile_photo)
                    <img
                        src="{{ asset('storage/' . $application->freelancer->profile_photo) }}"
                        class="profile-photo"
                        alt="Foto Freelancer">
                @else
                    <div class="profile-initial">
                        {{ strtoupper(substr($application->freelancer->name, 0, 1)) }}
                    </div>
                @endif

                <div>
                    <h5 class="fw-bold mb-1">
                        {{ $application->freelancer->name }}
                    </h5>

                    <p class="text-muted mb-0 small">
                        {{ $application->freelancer->email }}
                    </p>
                </div>

                <div class="ms-auto">
                    @if($application->status === 'accepted')
                        <span class="badge bg-success">Terpilih</span>
                    @elseif($application->status === 'rejected')
                        <span class="badge bg-secondary">Tidak Terpilih</span>
                    @else
                        <span class="badge bg-warning text-dark">Menunggu</span>
                    @endif
                </div>

            </div>

            <hr>

            {{-- PESAN PROPOSAL --}}
            <h6 class="fw-bold">Pesan Penawaran</h6>

            <p>
                {{ $application->message ?? 'Tidak ada pesan tambahan.' }}
            </p>

            {{-- HARGA DAN DURASI --}}
            <div class="row g-3 mb-4">

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-label">Harga Penawaran</div>

                        <div class="info-value text-success">
                            @if($application->price !== null)
                                Rp{{ number_format((float) $application->price, 0, ',', '.') }}
                            @else
                                Belum diisi
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="info-box">
                        <div class="info-label">Estimasi Pengerjaan</div>

                        <div class="info-value">
                            {{ $application->duration ?? 'Belum diisi' }}
                        </div>
                    </div>
                </div>

            </div>

            {{-- PILIH FREELANCER --}}
            @if($serviceRequest->status === 'open' && $application->status === 'pending')

                <form
                    action="{{ route('client.service-requests.select', [$serviceRequest->id, $application->id]) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin memilih freelancer ini?')">

                    @csrf

                    <button type="submit" class="btn btn-purple">
                        Pilih Freelancer
                    </button>

                </form>

            @elseif($application->status === 'accepted')

                <div class="alert alert-success mb-3">
                    Freelancer ini telah kamu pilih.
                </div>

                @if($application->freelancer->whatsapp_number)

                    @php
                        $phone = preg_replace(
                            '/\D+/',
                            '',
                            $application->freelancer->whatsapp_number
                        );

                        if (str_starts_with($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                    @endphp

                    <a
                        href="https://wa.me/{{ $phone }}?text={{ urlencode('Halo, saya client dari FreelanceHub. Saya memilih Anda untuk proyek ' . $serviceRequest->title . '.') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-success">

                        Hubungi via WhatsApp
                    </a>

                @else

                    <p class="text-danger small mb-0">
                        Freelancer belum menambahkan nomor WhatsApp pada profilnya.
                    </p>

                @endif

            @elseif($application->status === 'rejected')

                <span class="text-muted small">
                    Proposal ini tidak terpilih.
                </span>

            @endif

        </div>

    @empty

        <div class="content-card text-center py-5">
            <h5>Belum Ada Proposal</h5>

            <p class="text-muted mb-0">
                Belum ada freelancer yang mengajukan penawaran untuk proyek ini.
            </p>
        </div>

    @endforelse

</div>

</body>
</html>
