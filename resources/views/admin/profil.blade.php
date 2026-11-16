
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil Admin - FreelanceHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            color: #26334d;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: #17243d;
            position: fixed;
            padding: 30px 20px;
            color: white;
        }

        .sidebar h2 {
            color: #e7bd67;
            margin-bottom: 40px;
            font-size: 23px;
        }

        .sidebar a {
            display: block;
            color: #dce2ed;
            text-decoration: none;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #263957;
            color: #e7bd67;
        }

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 27px;
            margin-bottom: 8px;
        }

        .header p {
            color: #7b8495;
        }

        .profile-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 850px;
            box-shadow: 0 3px 12px rgba(0,0,0,.04);
        }

        .profile-photo {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-photo img {
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #e7bd67;
            margin-bottom: 15px;
        }

        .profile-photo h3 {
            margin-bottom: 6px;
        }

        .profile-photo p {
            color: #8992a2;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 9px;
            font-weight: bold;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dce1e9;
            border-radius: 8px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #d5aa50;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        button {
            border: none;
            border-radius: 8px;
            padding: 12px 20px;
            cursor: pointer;
            font-weight: bold;
        }

        button:disabled {
            opacity: .5;
            cursor: not-allowed;
        }

        .btn-save {
            background: #17243d;
            color: white;
        }

        .btn-delete {
            background: #fff0f0;
            color: #c0392b;
        }

        .btn-upload {
            display: inline-block;
            background: #263957;
            color: white;
            padding: 10px 17px;
            border-radius: 7px;
            cursor: pointer;
            font-size: 13px;
        }

        .alert {
            padding: 13px;
            background: #e6f6eb;
            color: #247a42;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error {
            color: #c0392b;
            font-size: 13px;
            margin-top: 6px;
        }

        @media(max-width: 768px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <h2>FreelanceHub</h2>

        <a href="/admin/dashboard">▦ Dashboard</a>
        <a href="/admin/orders">▤ Pesanan</a>
        <a href="/admin/freelancers">♙ Freelancer</a>
        <a href="/admin/review">☆ Review dan Rating</a>
        <a href="/admin/laporan">▥ Laporan</a>
        <a href="{{ route('admin.profil') }}" class="active">⚙ Pengaturan Profil</a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="
                width:100%;
                padding:13px;
                margin-top:20px;
                background:#263957;
                color:white;
                text-align:left;
            ">
                ↪ Logout
            </button>
        </form>
    </aside>

    <main class="main">

        <div class="header">
            <h1>Pengaturan Profil</h1>
            <p>Kelola informasi dan foto profil akun Admin kamu.</p>
        </div>

        <div class="profile-card">

            @if(session('status') === 'profile-updated')
                <div class="alert">
                    Profil berhasil diperbarui!
                </div>
            @endif

            @if(session('status') === 'photo-deleted')
                <div class="alert">
                    Foto profil berhasil dihapus!
                </div>
            @endif

            @if($errors->any())
                <div class="alert" style="background:#fff0f0;color:#c0392b;">
                    Periksa kembali data yang kamu masukkan.
                </div>
            @endif

            <form action="{{ route('admin.profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="profile-photo">

                    <img
                        id="preview"
                        src="{{ auth()->user()->profile_photo
                            ? asset('storage/' . auth()->user()->profile_photo)
                            : 'https://placehold.co/130x130?text=Admin' }}"
                        alt="Foto Profil">

                    <h3>{{ auth()->user()->name }}</h3>
                    <p>Administrator FreelanceHub</p>

                    <br>

                    <label for="profile_photo" class="btn-upload">
                        Ganti Foto Profil
                    </label>

                    <input
                        type="file"
                        id="profile_photo"
                        name="profile_photo"
                        accept=".jpg,.jpeg,.png,.webp"
                        hidden
                        onchange="previewImage(event)">

                    @error('profile_photo')
                        <p class="error">{{ $message }}</p>
                    @enderror

                    <p style="margin-top:12px;">
                        Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                    </p>

                </div>

                <div class="form-group">
                    <label>Nama Lengkap</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', auth()->user()->name) }}"
                        required>

                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', auth()->user()->email) }}"
                        required>

                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="buttons">
                    <button type="submit" class="btn-save">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

            <!-- FORM HAPUS FOTO PROFIL -->
            <form action="{{ route('admin.profile.deletePhoto') }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus foto profil?')">

                @csrf
                @method('DELETE')

                <div class="buttons">
                    <button
                        type="submit"
                        class="btn-delete"
                        {{ auth()->user()->profile_photo ? '' : 'disabled' }}>
                        Hapus Foto Profil
                    </button>
                </div>

            </form>

        </div>

    </main>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];

            if (file) {
                document.getElementById('preview').src =
                    URL.createObjectURL(file);
            }
        }
    </script>

</body>
</html>
