<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #FAF9FF;
            color: #30264B;
        }

        .navbar {
            background: #7047EB;
            color: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            transition: 0.2s;
        }

        .navbar a:hover {
            color: #EDE7FF;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .container h1 {
            color: #7047EB;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #837B99;
            margin-bottom: 30px;
        }

        .profile-card {
            background: white;
            border: 1px solid #E7E1F4;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(80, 48, 181, 0.08);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid #E7E1F4;
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: #EDE7FF;
            color: #7047EB;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .profile-header h2 {
            margin: 0 0 8px;
            color: #30264B;
        }

        .profile-header p {
            margin: 0;
            color: #837B99;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #30264B;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #DCD4EF;
            border-radius: 8px;
            font-size: 14px;
            font-family: Arial, sans-serif;
            color: #30264B;
            background: #FFFEFF;
            transition: 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #7047EB;
            box-shadow: 0 0 0 3px rgba(112, 71, 235, 0.10);
        }

        .form-group input[readonly] {
            background: #F4F1FC;
            color: #837B99;
        }

        .btn {
            background: #7047EB;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn:hover {
            background: #5030B5;
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 18px 25px;
                flex-direction: column;
                gap: 15px;
            }

            .navbar a {
                margin: 0 8px;
            }

            .container {
                width: 92%;
            }

            .profile-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>Freelance Lokal</h2>

        <div>
            <a href="/client/dashboard">Dashboard</a>
            <a href="/client/jasa">Cari Jasa</a>
            <a href="/client/pesanan">Pesanan Saya</a>
            <a href="/logout">Logout</a>
        </div>
    </nav>

    <main class="container">
        <h1>Profil Saya</h1>
        <p class="subtitle">
            Kelola informasi akun kamu.
        </p>

        <div class="profile-card">

            <div class="profile-header">
                <div class="avatar">C</div>

                <div>
                    <h2>Profil Client</h2>
                    <p>Kelola data pribadi akun kamu</p>
                </div>
            </div>

            <form action="{{ route('client.profil.update') }}" method="POST">
    @csrf
    @method('PUT')

    @if (session('success'))
        <div style="background:#E1F8ED;color:#16845F;padding:12px;border-radius:8px;margin-bottom:18px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background:#FFF0F1;color:#B42332;padding:12px;border-radius:8px;margin-bottom:18px;">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', auth()->user()->name) }}"
            required
        >
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', auth()->user()->email) }}"
            required
        >
    </div>

    <div class="form-group">
        <label for="role">Role</label>
        <input
            type="text"
            id="role"
            value="{{ ucfirst(auth()->user()->role) }}"
            readonly
        >
    </div>

    <div class="form-group">
        <label for="deskripsi">Deskripsi Diri</label>
        <textarea
            id="deskripsi"
            name="deskripsi"
            rows="4"
            placeholder="Tuliskan deskripsi singkat tentang diri kamu"
        >{{ old('deskripsi') }}</textarea>
    </div>

    <button type="submit" class="btn">
        Simpan Perubahan
    </button>
</form>

        </div>
    </main>

</body>
</html>