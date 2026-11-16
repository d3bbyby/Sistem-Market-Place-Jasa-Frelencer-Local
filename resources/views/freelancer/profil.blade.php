
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Freelancer - FreelanceHub</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #F2FAF9;
            color: #183B3A;
        }

        .workspace {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 250px;
            padding: 25px 18px;
            background: #12514C;
        }

        .logo {
            padding: 0 15px;
            margin-bottom: 35px;
            font-size: 24px;
            font-weight: bold;
            color: white;
        }

        .menu-title {
            margin: 0 15px 12px;
            color: #A9D4CE;
            font-size: 12px;
            text-transform: uppercase;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
            padding: 13px 15px;
            border-radius: 9px;
            color: #E0F0EE;
            text-decoration: none;
            font-size: 14px;
        }

        .menu a:hover,
        .menu a.active {
            background: #D9F3EF;
            color: #12514C;
        }

        .menu-icon {
            width: 20px;
            text-align: center;
        }

        .profile-main {
            flex: 1;
            margin-left: 250px;
            padding: 35px;
        }

        .container {
            max-width: 700px;
            margin: auto;
        }

        .title {
            margin-bottom: 25px;
        }

        .title h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .title p {
            color: #72918D;
        }

        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 35px;
            border: 1px solid #D8EAE7;
            box-shadow: 0 8px 24px rgba(18,81,76,.06);
        }

        .avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #0E756D;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            font-weight: bold;
            overflow: hidden;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-role {
            text-align: center;
            color: #72918D;
            margin-bottom: 25px;
        }

        .alert {
            padding: 13px;
            border-radius: 9px;
            margin-bottom: 18px;
            background: #E0F5F1;
            color: #0E756D;
        }

        .error {
            color: #C0392B;
            font-size: 13px;
            margin-top: 6px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 13px;
            border: 1px solid #D8EAE7;
            border-radius: 9px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #0E756D;
        }

        .help {
            color: #72918D;
            font-size: 12px;
            margin-top: 6px;
        }

        .btn {
            display: block;
            width: 100%;
            margin-top: 15px;
            padding: 13px;
            text-align: center;
            background: #0E756D;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #12514C;
        }

        .btn-delete {
            background: #FDECEC;
            color: #C0392B;
        }

        .btn-delete:hover {
            background: #F8D7DA;
        }

        .photo-label {
            display: block;
            text-align: center;
            margin-bottom: 25px;
            color: #0E756D;
            cursor: pointer;
            font-size: 13px;
            font-weight: bold;
        }

        @media(max-width:760px) {
            .workspace {
                display: block;
            }

            .sidebar {
                position: static;
                width: 100%;
                padding: 18px;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
            }

            .menu a {
                margin: 0;
            }

            .profile-main {
                margin-left: 0;
                padding: 24px 16px;
            }

            .profile-card {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
<div class="workspace">

    <aside class="sidebar">
        <div class="logo">FreelanceHub</div>

        <p class="menu-title">Menu Utama</p>

        <nav class="menu">
            <a href="{{ route('freelancer.dashboard') }}">
                <span class="menu-icon">▣</span>Dashboard
            </a>

            <a href="{{ route('freelancer.profil') }}" class="active">
                <span class="menu-icon">♙</span>Profil Saya
            </a>

            <a href="/freelancer/jasa">
                <span class="menu-icon">▤</span>Jasa Saya
            </a>

            <a href="{{ route('freelancer.orders.index') }}">
                <span class="menu-icon">▧</span>Pesanan Masuk
            </a>

            <a href="/freelancer/portofolio">
                <span class="menu-icon">▧</span>Portofolio
            </a>

            <a href="{{ route('freelancer.service-requests.index') }}">
                <span class="menu-icon">▦</span>Posting Kebutuhan Client
            </a>

            <form method="POST" action="{{ route('logout') }}" style="display:contents;">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    <span class="menu-icon">↪</span>Logout
                </a>
            </form>
        </nav>
    </aside>

    <main class="profile-main">
        <div class="container">

            <div class="title">
                <h1>Profil Saya</h1>
                <p>Kelola informasi akun freelancer kamu.</p>
            </div>

            <div class="profile-card">

                @if(session('status') === 'profile-updated')
                    <div class="alert">Profil berhasil diperbarui!</div>
                @endif

                @if(session('status') === 'photo-deleted')
                    <div class="alert">Foto profil berhasil dihapus!</div>
                @endif

                @if($errors->any())
                    <div class="alert" style="background:#FDECEC;color:#C0392B;">
                        Periksa kembali data yang kamu masukkan.
                    </div>
                @endif

                <div class="avatar">
                    @if(Auth::user()->profile_photo)
                        <img id="preview"
                             src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                             alt="Foto Profil">
                    @else
                        <img id="preview"
                             src="https://placehold.co/100x100?text=Foto"
                             alt="Foto Profil"
                             style="display:none;">
                        <span id="initial">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </span>
                    @endif
                </div>

                <div class="profile-name">
                    {{ Auth::user()->name }}
                </div>

                <div class="profile-role">
                    Freelancer
                </div>

                <form action="{{ route('freelancer.profile.update') }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label>Foto Profil</label>
                        <input type="file"
                               name="profile_photo"
                               accept=".jpg,.jpeg,.png,.webp"
                               onchange="previewImage(event)">
                        <p class="help">Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.</p>
                        @error('profile_photo')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', Auth::user()->name) }}"
                               required>
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', Auth::user()->email) }}"
                               required>
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Nomor WhatsApp</label>
                        <input type="text"
                               name="whatsapp_number"
                               value="{{ old('whatsapp_number', Auth::user()->whatsapp_number) }}"
                               placeholder="Contoh: 081234567890">
                        <p class="help">Nomor ini akan digunakan client untuk menghubungi kamu.</p>
                        @error('whatsapp_number')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn">
                        Simpan Perubahan
                    </button>
                </form>

                <form action="{{ route('freelancer.profile.deletePhoto') }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus foto profil?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-delete"
                            {{ Auth::user()->profile_photo ? '' : 'disabled' }}>
                        Hapus Foto Profil
                    </button>
                </form>

                <a href="{{ route('freelancer.dashboard') }}" class="btn">
                    Kembali ke Dashboard
                </a>

            </div>
        </div>
    </main>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];

        if (file) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';

            const initial = document.getElementById('initial');
            if (initial) initial.style.display = 'none';
        }
    }
</script>

</body>
</html>
