<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User - FreelanceHub</title>

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
            max-width: 800px;
            margin: auto;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }

        .back-button {
            display: inline-block;
            padding: 12px 20px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #8b6346, #5c3d2e);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 10px;
            transition: 0.25s;
        }

        .back-button:hover {
            background: #432b20;
            transform: translateY(-2px);
        }

        h1 {
            margin: 0 0 10px;
            color: #5c3d2e;
            font-size: 28px;
        }

        .subtitle {
            margin-bottom: 25px;
            color: #887568;
            font-size: 14px;
        }

        .detail-card {
            padding: 22px;
            margin-bottom: 25px;
            background: #faf7f3;
            border: 1px solid #eee5dd;
            border-radius: 12px;
        }

        .detail-row {
            padding: 16px 0;
            border-bottom: 1px solid #e8ded4;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .label {
            display: block;
            margin-bottom: 8px;
            color: #887568;
            font-size: 13px;
        }

        .value {
            color: #3d3028;
            font-size: 16px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            background: #e9dfd5;
            color: #6f4e37;
        }

        .badge-admin {
            background: #eadcf5;
            color: #713e91;
        }

        .badge-freelancer {
            background: #dff3e4;
            color: #246c38;
        }

        .footer {
            margin-top: 25px;
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

        <a href="{{ route('users.index') }}" class="back-button">
            &#8592; Kembali ke Daftar User
        </a>

        <h1>Detail User</h1>
        <p class="subtitle">
            Informasi lengkap pengguna FreelanceHub.
        </p>

        <div class="detail-card">
            <div class="detail-row">
                <span class="label">ID User</span>
                <span class="value">{{ $user->id }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Nama Lengkap</span>
                <span class="value">{{ $user->name }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Email</span>
                <span class="value">{{ $user->email }}</span>
            </div>

            <div class="detail-row">
                <span class="label">Role</span>
                @php
                    $role = $user->role ?? 'client';
                    $badgeRole = in_array(
                        $role,
                        ['admin', 'freelancer', 'client']
                    ) ? $role : 'client';
                @endphp

                <span class="badge badge-{{ $badgeRole }}">
                    {{ ucfirst($role) }}
                </span>
            </div>
        </div>

        <div class="footer">
            FreelanceHub - Sistem Marketplace Jasa Freelancer Lokal
        </div>

    </div>
</body>
</html>