<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Freelancer</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f8f5f2;
            color: #4b3426;
        }

        .navbar {
            height: 70px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #6b4226;
        }

        .back {
            text-decoration: none;
            color: #6b4226;
            font-weight: bold;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 50px auto;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .title p {
            color: #8a7668;
        }

        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: #6b4226;
            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 38px;
            font-weight: bold;
        }

        .profile-name {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-role {
            text-align: center;
            color: #9a6a45;
            margin-bottom: 30px;
        }

        .data-box {
            background: #f8f5f2;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 15px;
        }

        .data-box small {
            display: block;
            color: #8a7668;
            margin-bottom: 5px;
        }

        .data-box strong {
            font-size: 16px;
            color: #4b3426;
        }

        .status {
            display: inline-block;
            background: #e8f5e9;
            color: #388e3c;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .btn {
            display: block;
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            text-align: center;

            background: #6b4226;
            color: white;
            text-decoration: none;

            border-radius: 10px;
            font-weight: bold;
        }

        .btn:hover {
            background: #8a5a38;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            FreelanceLocal
        </div>
        <a href="/freelancer/dashboard" class="back">
            ← Kembali ke Dashboard
        </a>
    </div>


    <div class="container">
        <div class="title">
            <h1>Profil Saya</h1>
            <p>Informasi akun freelancer</p>
        </div>
        <div class="profile-card">
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="profile-name">
                {{ Auth::user()->name }}
            </div>

            <div class="profile-role">
                {{ ucfirst(Auth::user()->role) }}
            </div>


            <div class="data-box">
                <small>Nama Lengkap</small>
                <strong>{{ Auth::user()->name }}</strong>
            </div>

            <div class="data-box">
                <small>Email</small>
                <strong>{{ Auth::user()->email }}</strong>
            </div>

            <div class="data-box">
                <small>Role</small>
                <strong>{{ ucfirst(Auth::user()->role) }}</strong>
            </div>

            <div class="data-box">
                <small>Status Akun</small>
                <span class="status">
                    Aktif
                </span>
            </div>


            <a href="/freelancer/dashboard" class="btn">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>