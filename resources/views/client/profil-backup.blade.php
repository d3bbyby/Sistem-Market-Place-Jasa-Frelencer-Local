```blade
@php
    $user = auth()->user();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Client - FreelanceHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #F7F6FF;
            color: #30264B;
        }

        .navbar {
            min-height: 75px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 5%;
            box-shadow: 0 2px 10px rgba(77, 53, 140, 0.06);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #7047EB;
        }

        .back {
            text-decoration: none;
            color: #7047EB;
            font-weight: bold;
            font-size: 14px;
        }

        .back:hover {
            color: #5030B5;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 45px auto;
        }

        .title {
            text-align: center;
            margin-bottom: 28px;
        }

        .title h1 {
            font-size: 29px;
            margin-bottom: 9px;
        }

        .title p {
            color: #89829E;
            font-size: 14px;
        }

        .profile-card {
            background: white;
            border: 1px solid #E9E5F5;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 8px 25px rgba(77, 53, 140, 0.06);
        }

        .avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 28px;
            background: linear-gradient(135deg, #9878FF, #623BDE);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            font-weight: bold;
            box-shadow: 0 7px 18px rgba(112, 71, 235, 0.2);
        }

        .profile-name {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 7px;
            overflow-wrap: anywhere;
        }

        .profile-role {
            text-align: center;
            color: #7047EB;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .data-box {
            background: #F8F6FF;
            border: 1px solid #EEE9FB;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 14px;
            overflow-wrap: anywhere;
        }

        .data-box small {
            display: block;
            color: #89829E;
            margin-bottom: 7px;
            font-size: 12px;
        }

        .data-box strong {
            font-size: 15px;
            color: #30264B;
        }

        .status {
            display: inline-block;
            background: #E5FAF1;
            color: #159B72;
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .btn {
            display: block;
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            text-align: center;
            background: linear-gradient(135deg, #8464F7, #6842E6);
            color: white;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            background: #5030B5;
        }

        @media (max-width: 500px) {
            .navbar {
                padding: 15px 5%;
            }

            .logo {
                font-size: 18px;
            }

            .back {
                font-size: 12px;
            }

            .container {
                margin: 30px auto;
            }

            .profile-card {
                padding: 24px 18px;
            }

            .title h1 {
                font-size: 25px;
            }

            .profile-name {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">FreelanceHub</div>

        <a href="{{ url('/client/dashboard') }}" class="back">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="container">

        <div class="title">
            <h1>Pengaturan Akun</h1>
            <p>Informasi akun Client kamu</p>
        </div>

        <div class="profile-card">

            <div class="avatar">
                {{ strtoupper(substr($user?->name ?? 'C', 0, 1)) }}
            </div>

            <div class="profile-name">
                {{ $user?->name ?? 'Pengguna' }}
            </div>

            <div class="profile-role">
                {{ ucfirst($user?->role ?? 'client') }}
            </div>

            <div class="data-box">
                <small>Nama Lengkap</small>
                <strong>{{ $user?->name ?? '-' }}</strong>
            </div>

            <div class="data-box">
                <small>Email</small>
                <strong>{{ $user?->email ?? '-' }}</strong>
            </div>

            <div class="data-box">
                <small>Role Akun</small>
                <strong>{{ ucfirst($user?->role ?? 'client') }}</strong>
            </div>

            <div class="data-box">
                <small>Status Akun</small>
                <span class="status">Aktif</span>
            </div>

            <a href="{{ url('/client/dashboard') }}" class="btn">
                Kembali ke Dashboard
            </a>

        </div>

    </div>

</body>
</html>