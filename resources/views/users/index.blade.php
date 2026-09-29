<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 20px;
        }

        a, button {
            padding: 8px 12px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .tambah {
            background: #198754;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .edit {
            background: #ffc107;
            color: black;
        }

        .detail {
            background: #0d6efd;
            color: white;
        }

        .hapus {
            background: #dc3545;
            color: white;
        }

        .success {
            background: #d1e7dd;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Data User</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('users.create') }}" class="tambah">
        + Tambah User
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>

                        <a href="{{ route('users.show', $user->id) }}"
                           class="detail">
                            Detail
                        </a>

                        <a href="{{ route('users.edit', $user->id) }}"
                           class="edit">
                            Edit
                        </a>

                        <form action="{{ route('users.destroy', $user->id) }}"
                              method="POST"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="hapus"
                                    onclick="return confirm('Yakin ingin menghapus user ini?')">
                                Hapus
                            </button>

                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        Belum ada data user.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>