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
            background: #fffaf5;
            color: #4b2e1f;
        }

        .navbar {
            background: #6b4226;
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
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .container h1 {
            color: #6b4226;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #806f63;
            margin-bottom: 30px;
        }

        .profile-card {
            background: white;
            border: 1px solid #eadbd0;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(75, 46, 31, 0.08);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eadbd0;
        }

        .avatar {
            width: 80px;
            height: 80px;
            background: #eadbd0;
            color: #6b4226;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
        }

        .profile-header h2 {
            margin: 0 0 8px;
        }

        .profile-header p {
            margin: 0;
            color: #806f63;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d6c2b2;
            border-radius: 8px;
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6b4226;
        }

        .btn {
            background: #6b4226;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn:hover {
            background: #4b2e1f;
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

            <form action="#" method="POST">
                @csrf

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="Nama Client"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="client@gmail.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <input
                        type="text"
                        id="role"
                        name="role"
                        value="Client"
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
                    ></textarea>
                </div>

                <button type="submit" class="btn">
                    Simpan Perubahan
                </button>
            </form>

        </div>
    </main>

</body>
</html>