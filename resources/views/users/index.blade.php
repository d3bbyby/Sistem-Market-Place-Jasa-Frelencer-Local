
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
            background: #F4F6FA;
            color: #1E2C3D;
        }

        .container {
            max-width: 1150px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(16, 39, 68, 0.08);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 20px;
            margin-bottom: 25px;
            background: linear-gradient(135deg, #1C3B60, #142B49);
            color: white;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(20, 43, 73, 0.2);
            transition: 0.25s;
        }

        .back-button:hover {
            background: #0F2036;
            transform: translateY(-2px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding-bottom: 20px;
            border-bottom: 1px solid #E1E6EE;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 10px;
            color: #1E2C3D;
            font-size: 28px;
        }

        .subtitle {
            margin: 0;
            color: #7A8798;
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
            background: #C49A45;
            color: #142B49;
        }

        .btn-add:hover {
            background: #A87922;
            color: white;
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
            background: #142B49;
            color: white;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #E6EBF2;
            font-size: 14px;
        }

        tbody tr:hover {
            background: #F4F6FA;
        }

        .badge {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-admin {
            background: #F8F0DD;
            color: #A87922;
        }

        .badge-freelancer {
            background: #E6EDF5;
            color: #36577E;
        }

        .badge-client {
            background: #E3EAF2;
            color: #243B53;
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

        .btn-icon {
            width: 36px;
            height: 36px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-icon svg {
            width: 17px;
            height: 17px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .btn-detail {
            background: #E9EFF6;
            color: #36577E;
        }

        .btn-detail:hover {
            background: #D8E2EE;
        }

        .btn-edit {
            background: #F8F0DD;
            color: #8C641E;
        }

        .btn-edit:hover {
            background: #EBD9A9;
        }

        .btn-delete {
            background: #FCE4E4;
            color: #C74747;
        }

        .btn-delete:hover {
            background: #F5CCCC;
        }

        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            background: #E0F3E5;
            color: #246C38;
            border: 1px solid #B7E0C2;
            border-radius: 8px;
        }

        .empty {
            padding: 35px;
            text-align: center;
            color: #7A8798;
        }

        .footer {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid #E1E6EE;
            text-align: center;
            font-size: 12px;
            color: #8B98A8;
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
        .search-box {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-box input {
    flex: 1;
    padding: 12px 15px;
    border: 1px solid #D5DCE5;
    border-radius: 8px;
    font-size: 14px;
}

.search-box button {
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    background: #1C3B60;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.search-box button:hover {
    background: #142B49;
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

        <!-- PENCARIAN USER -->
<div class="search-box">
    <input type="text" id="searchUser" placeholder="Cari nama, email, atau role...">
    <button type="button" id="btnSearch">Cari</button>
</div>

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
                                       class="btn-icon btn-detail"
                                       title="Detail">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route('users.edit', $user->id) }}"
                                       class="btn-icon btn-edit"
                                       title="Edit">
                                        <svg viewBox="0 0 24 24">
                                            <path d="m16 4 4 4L8 20H4v-4L16 4Z"/>
                                        </svg>
                                    </a>

                                    <!-- HAPUS -->
                                    <form action="{{ route('users.destroy', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn-icon btn-delete"
                                                title="Hapus">
                                            <svg viewBox="0 0 24 24">
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="m19 6-1 14H6L5 6"/>
                                                <path d="M10 11v5M14 11v5"/>
                                            </svg>
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
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchUser');
    const searchButton = document.getElementById('btnSearch');
    const rows = document.querySelectorAll('table tbody tr');

    function cariUser() {
        const keyword = searchInput.value.toLowerCase().trim();

        rows.forEach(function (row) {
            const isiBaris = row.textContent.toLowerCase();

            row.style.display = isiBaris.includes(keyword) ? '' : 'none';
        });
    }

    searchButton.addEventListener('click', cariUser);

    searchInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') {
            cariUser();
        }
    });
});
</script>
</body>
</html>
