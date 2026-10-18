<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Freelancer - FreelanceHub</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #FAF9FF; color: #30264B; }
        .navbar { background: #7047EB; color: white; padding: 18px 6%; display: flex; justify-content: space-between; align-items: center; }
        .navbar h2 { margin: 0; }
        .navbar a { color: white; text-decoration: none; }
        .container { width: 90%; max-width: 1000px; margin: 40px auto; }
        .subtitle { color: #837B99; margin: 8px 0 25px; }
        .table-box { background: white; padding: 22px; border-radius: 15px; border: 1px solid #E7E1F4; overflow-x: auto; }
        table { width: 100%; min-width: 650px; border-collapse: collapse; }
        th { background: #7047EB; color: white; text-align: left; padding: 13px; font-size: 13px; }
        td { padding: 14px 13px; border-bottom: 1px solid #EDE8F7; color: #625976; }
        .actions { display: flex; gap: 8px; }
        .button { border: 0; border-radius: 7px; background: #7047EB; color: white; padding: 9px 13px; cursor: pointer; }
        .button.reject { background: #9B3E5B; }
        .alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 18px; background: #EAF8EF; color: #28643A; }
        .empty { text-align: center; padding: 35px; color: #837B99; }
        @media (max-width: 600px) { .container { width: 94%; } .table-box { padding: 12px; } }
    </style>
</head>
<body>
    <nav class="navbar">
        <h2>FreelanceHub</h2>
        <a href="/admin/dashboard">Dashboard</a>
    </nav>
    <main class="container">
        <h1>Verifikasi Freelancer</h1>
        <p class="subtitle">Tinjau dan perbarui status akun freelancer.</p>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif
        <section class="table-box">
            <table>
                <thead><tr><th>Nama</th><th>Email</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse ($freelancers as $freelancer)
                        <tr>
                            <td>{{ $freelancer->name }}</td>
                            <td>{{ $freelancer->email }}</td>
                            <td>{{ $freelancer->verification_status }}</td>
                            <td>
                                <div class="actions">
                                    <form method="POST" action="{{ route('admin.freelancers.updateVerification', $freelancer) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="verification_status" value="verified">
                                        <button class="button" type="submit">Verifikasi</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.freelancers.updateVerification', $freelancer) }}">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="verification_status" value="rejected">
                                        <button class="button reject" type="submit">Tolak</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="empty">Belum ada freelancer terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
