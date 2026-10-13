
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Freelancer - FreelanceHub</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 20px;
            font-family: Arial, sans-serif;
            background: #f5f1eb;
            color: #3d3028;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #8b6346, #5c3d2e);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(92,61,46,0.25);
            transition: 0.25s;
        }

        .back-button:hover {
            background: #432b20;
            transform: translateY(-2px);
        }

        h1 {
            font-size: 28px;
            margin: 0 0 10px;
            color: #5c3d2e;
        }

        .subtitle {
            color: #887568;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .header {
            padding-bottom: 20px;
            border-bottom: 1px solid #e8ded4;
            margin-bottom: 25px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        thead {
            background: #6f4e37;
            color: white;
        }

        th {
            padding: 16px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #eee5dd;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #faf7f3;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .pending {
            background: #fff3d6;
            color: #996500;
        }

        .verified {
            background: #dff3e4;
            color: #246c38;
        }

        .rejected {
            background: #fde3e3;
            color: #a32929;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn {
            padding: 9px 15px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-verify {
            background: #2e8b57;
            color: white;
        }

        .btn-verify:hover {
            background: #216c42;
        }

        .btn-reject {
            background: #c74747;
            color: white;
        }

        .btn-reject:hover {
            background: #a82e2e;
        }

        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
        }

        .alert-success {
            background: #e0f3e5;
            color: #246c38;
            border: 1px solid #b7e0c2;
        }

        .empty {
            padding: 45px 20px;
            text-align: center;
            color: #887568;
            background: #faf7f3;
            border-radius: 12px;
        }

        .empty h3 {
            margin-bottom: 8px;
            color: #5c3d2e;
        }

        .footer {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid #eee5dd;
            text-align: center;
            color: #a39487;
            font-size: 12px;
        }

        @media (max-width: 600px) {
            body {
                padding: 15px;
            }

            .container {
                padding: 20px 15px;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- TOMBOL BACK -->
        <a href="/admin/dashboard" class="back-button">
            &#8592; Kembali ke Dashboard
        </a>

        <!-- HEADER -->
        <div class="header">
            <h1>Verifikasi Freelancer</h1>
            <p class="subtitle">
                Kelola dan verifikasi akun freelancer yang terdaftar.
            </p>
        </div>

        <!-- PESAN SUKSES -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- DAFTAR FREELANCER -->
        @if ($freelancers->isEmpty())

            <div class="empty">
                <h3>Belum Ada Freelancer</h3>
                <p>Belum ada akun freelancer yang terdaftar.</p>
            </div>

        @else

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Freelancer</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($freelancers as $freelancer)
                            @php
                                $status = $freelancer->verification_status ?? 'pending';
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $freelancer->name }}</strong>
                                </td>

                                <td>{{ $freelancer->email }}</td>

                                <td>
                                    <span class="badge {{ $status }}">
                                        @if ($status === 'verified')
                                            Terverifikasi
                                        @elseif ($status === 'rejected')
                                            Ditolak
                                        @else
                                            Menunggu
                                        @endif
                                    </span>
                                </td>

                                <td>
                                    <div class="actions">

                                        @if ($status !== 'verified')
                                            <form
                                                action="{{ route('admin.freelancers.verify', $freelancer->id) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn btn-verify"
                                                    onclick="return confirm('Yakin ingin memverifikasi freelancer ini?')"
                                                >
                                                    Verifikasi
                                                </button>
                                            </form>
                                        @endif

                                        @if ($status !== 'rejected')
                                            <form
                                                action="{{ route('admin.freelancers.reject', $freelancer->id) }}"
                                                method="POST"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    class="btn btn-reject"
                                                    onclick="return confirm('Yakin ingin menolak freelancer ini?')"
                                                >
                                                    Tolak
                                                </button>
                                            </form>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

        <!-- FOOTER -->
        <div class="footer">
            FreelanceHub - Sistem Marketplace Jasa Freelancer Lokal
        </div>

    </div>
</body>
</html>
