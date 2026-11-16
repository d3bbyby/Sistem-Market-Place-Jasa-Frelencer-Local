<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #FAF9FF;
            color: #30264B;
        }

        .navbar {
            height: 70px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
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
            color: #837B99;
        }

        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .avatar {
            width: 110px;
            height: 110px;
            margin: 0 auto 15px;
            border-radius: 50%;
            background: #7047EB;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            font-weight: bold;
            object-fit: cover;
        }

        .profile-name {
            text-align: center;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-role {
            text-align: center;
            color: #837B99;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 13px;
            border: 1px solid #E9E5F5;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #7047EB;
        }

        .form-group small {
            display: block;
            color: #837B99;
            margin-top: 7px;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .success {
            background: #e8f5e9;
            color: #388e3c;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-group input[type="file"] {
            padding: 10px;
            background: #FAF9FF;
        }

        .btn {
            display: block;
            width: 100%;
            margin-top: 25px;
            padding: 14px;
            text-align: center;
            background: #7047EB;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
        }

        .btn:hover {
            background: #5030B5;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 20px;
            }

            .profile-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

    @php
        $user = Auth::user();
    @endphp

    <div class="navbar">
        <div class="logo">FreelanceLocal</div>

        <a href="{{ route('client.dashboard') }}" class="back">
            ← Kembali ke Dashboard
        </a>
    </div>

    <div class="container">

        <div class="title">
            <h1>Profil Client</h1>
            <p>Kelola informasi akun kamu</p>
        </div>

        <div class="profile-card">

            @if(session('status') === 'profile-updated')
                <div class="success">
                    Profil berhasil diperbarui!
                </div>
            @endif

            @if(session('status') === 'photo-deleted')
                <div class="success">
                    Foto profil berhasil dihapus!
                </div>
            @endif

            <div style="text-align: center;">

                @if($user->profile_photo)
                    <img
                        src="{{ asset('storage/' . $user->profile_photo) }}"
                        class="avatar"
                        alt="Foto Profil"
                    >
                @else
                    <div class="avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                @if($user->profile_photo)
                    <form
                        action="{{ route('client.profile.deletePhoto') }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus foto profil?')"
                        style="margin-bottom: 20px;"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" style="
                            background: #fff0f0;
                            color: #dc2626;
                            border: none;
                            padding: 9px 18px;
                            border-radius: 8px;
                            cursor: pointer;
                            font-weight: bold;
                        ">
                            Hapus Foto
                        </button>
                    </form>
                @endif

                <div class="profile-name">
                    {{ $user->name }}
                </div>

                <div class="profile-role">
                    {{ ucfirst($user->role) }}
                </div>

            </div>

            <form
                action="{{ route('client.profile.update') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="whatsapp_number">Nomor WhatsApp</label>
                    <input
                        id="whatsapp_number"
                        type="tel"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $user->whatsapp_number) }}"
                        maxlength="20"
                        autocomplete="tel"
                    >

                    @error('whatsapp_number')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="profile_photo">Foto Profil</label>
                    <input
                        id="profile_photo"
                        type="file"
                        name="profile_photo"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>
                        Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                    </small>

                    @error('profile_photo')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </div>

</body>
</html>
