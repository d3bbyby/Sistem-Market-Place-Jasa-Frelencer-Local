
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - FreelanceHub</title>

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
            max-width: 1150px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e8ded4;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 10px;
            color: #5c3d2e;
            font-size: 28px;
        }

        .subtitle {
            margin: 0;
            color: #887568;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            font-family: inherit;
        }

        .btn-add {
            background: #6f4e37;
            color: white;
        }

        .btn-add:hover {
            background: #503725;
        }

        .btn-detail {
            background: #e9dfd5;
            color: #5c3d2e;
        }

        .btn-detail:hover {
            background: #d8c7b8;
        }

        .btn-edit {
            background: #e7b75d;
            color: #4b3218;
        }

        .btn-edit:hover {
            background: #dba03d;
        }

        .btn-delete {
            background: #c74747;
            color: white;
        }

        .btn-delete:hover {
            background: #a82e2e;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        th {
            padding: 16px;
            background: #6f4e37;
            color: white;
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

        .badge-admin {
            background: #eadcf5;
            color: #713e91;
        }

        .badge-freelancer {
            background: #dff3e4;
            color: #246c38;
        }

        .badge-client {
            background: #e9dfd5;
            color: #6f4e37;
        }

        .actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .actions form {
            margin: 0;
        }

        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            background: #e0f3e5;
            color: #246c38;
            border: 1px solid #b7e0c2;
            border-radius: 8px;
        }

        .empty {
            padding: 35px;
            text-align: center;
            color: #887568;
        }

        .footer {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid #eee5dd;
            text-align: center;
            font-size: 12px;
            color: #a39487;
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

        <!-- TOMBOL KEMBALI -->
        <a href="/admin/dashboard" class="back-button">
            &#8592; Kembali ke Dashboard
        </a>

        <!-- HEADER -->
        <div class="header">
            <div>
                <h1>Kelola User</h1>
                <p class="subtitle">
                    Kelola data pengguna FreelanceHub.
                </p>
            </div>

            <a href="{{ route('users.create') }}" class="btn btn-add">
                + Tambah User
            </a>
        </div>

        <!-- PESAN BERHASIL -->
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABEL USER -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>

                            <td>{{ $user->email }}</td>

                            <td>
                                @php
                                    $role = $user->role ?? 'client';
                                @endphp

                                <span class="badge badge-{{ in_array($role, ['admin', 'freelancer', 'client']) ? $role : 'client' }}">
                                    {{ ucfirst($role) }}
                                </span>
                            </td>

                            <td>
                                <div class="actions">

                                    <!-- DETAIL -->
                                    <a href="{{ route('users.show', $user->id) }}"
                                       class="btn btn-detail">
                                        Detail
                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="btn btn-edit">
                                        Edit
                                    </a>

                                    <!-- HAPUS -->
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-delete">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty">
                                Belum ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            FreelanceHub - Sistem Marketplace Jasa Freelancer Lokal
        </div>

    </div>
</body>
</html>

