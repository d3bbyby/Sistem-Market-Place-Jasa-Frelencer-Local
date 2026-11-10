<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Freelancer - FreelanceHub</title>
    <style>
        :root {
            color-scheme: light;
            --primary: #7047EB;
            --primary-dark: #5030B5;
            --text: #30264B;
            --muted: #837B99;
            --border: #E7E1F4;
            --surface: #FFFFFF;
            --background: #F7F6FF;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            background:
                radial-gradient(circle at 90% 0, #EDE7FF 0, transparent 25rem),
                var(--background);
            color: var(--text);
            font-family: Arial, sans-serif;
        }

        a {
            -webkit-tap-highlight-color: transparent;
        }

        .navbar {
            display: flex;
            min-height: 76px;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 16px max(5%, calc((100% - 1120px) / 2));
            border-bottom: 1px solid #FFFFFF30;
            background: linear-gradient(115deg, #7047EB, #5933C6);
            color: white;
            box-shadow: 0 8px 24px #5030B51F;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            font-size: 19px;
            font-weight: 800;
            letter-spacing: -.3px;
        }

        .brand-mark {
            display: grid;
            width: 38px;
            height: 38px;
            place-items: center;
            border: 1px solid #FFFFFF45;
            border-radius: 12px;
            background: #FFFFFF24;
            font-size: 20px;
        }

        .navbar a {
            padding: 10px 14px;
            border: 1px solid #FFFFFF55;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background .2s ease, transform .2s ease;
        }

        .navbar a:hover {
            transform: translateY(-1px);
            background: #FFFFFF20;
        }

        .container {
            width: min(1120px, 90%);
            margin: 0 auto;
            padding: 48px 0 64px;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: var(--primary);
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.1px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 4vw, 38px);
            letter-spacing: -1px;
        }

        .subtitle {
            margin: 10px 0 28px;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
            padding: 14px 16px;
            border: 1px solid #BCE7C8;
            border-radius: 12px;
            background: #EAF8EF;
            color: #28643A;
            line-height: 1.5;
        }

        .table-box {
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 18px;
            background: var(--surface);
            box-shadow: 0 14px 40px #30264B0D;
        }

        .table-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 20px 24px;
            border-bottom: 1px solid #F0ECF8;
        }

        .table-heading h2 {
            margin: 0;
            font-size: 16px;
        }

        .count {
            padding: 6px 11px;
            border-radius: 999px;
            background: #F1EDFF;
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 800;
        }

        .table-scroll {
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 680px;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            padding: 13px 20px;
            background: #FAF9FF;
            color: #776E8D;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .7px;
            text-transform: uppercase;
        }

        td {
            padding: 17px 20px;
            border-bottom: 1px solid #F0ECF8;
            color: #625976;
            font-size: 14px;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        tbody tr:not(.empty-row):hover {
            background: #FCFBFF;
        }

        .freelancer-name {
            color: var(--text);
            font-weight: 700;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status::before {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: currentColor;
            content: "";
        }

        .status.pending {
            background: #FFF6DF;
            color: #936600;
        }

        .status.verified {
            background: #E8F7ED;
            color: #267343;
        }

        .status.rejected {
            background: #FCECEF;
            color: #A63A54;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .button {
            min-height: 36px;
            padding: 8px 12px;
            border: 1px solid transparent;
            border-radius: 9px;
            background: var(--primary);
            color: white;
            cursor: pointer;
            font: inherit;
            font-size: 12px;
            font-weight: 700;
            transition: background .2s ease, transform .2s ease;
        }

        .button:hover {
            transform: translateY(-1px);
            background: var(--primary-dark);
        }

        .button.reject {
            border-color: #F0D4DB;
            background: white;
            color: #9B3E5B;
        }

        .button.reject:hover {
            background: #FFF3F5;
        }

        .button:focus-visible,
        .navbar a:focus-visible {
            outline: 3px solid #A995FF;
            outline-offset: 3px;
        }

        .empty {
            padding: 42px 24px;
            color: var(--muted);
            text-align: center;
        }

        .empty strong {
            display: block;
            margin-bottom: 6px;
            color: var(--text);
            font-size: 15px;
        }

        @media (max-width: 640px) {
            .navbar {
                min-height: 66px;
                padding: 12px 5%;
            }

            .brand {
                font-size: 16px;
            }

            .brand-mark {
                width: 34px;
                height: 34px;
            }

            .container {
                width: 92%;
                padding: 34px 0 48px;
            }

            .table-heading {
                padding: 16px;
            }

            th,
            td {
                padding-right: 14px;
                padding-left: 14px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="brand">
            <span class="brand-mark" aria-hidden="true">F</span>
            <span>FreelanceHub</span>
        </div>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </nav>
    <main class="container">
        <p class="eyebrow">Pengelolaan akun</p>
        <h1>Verifikasi Freelancer</h1>
        <p class="subtitle">Tinjau dan perbarui status akun freelancer.</p>
        @if (session('success'))
            <div class="alert" role="status">
                <span aria-hidden="true">✓</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        <section class="table-box">
            <div class="table-heading">
                <h2>Daftar freelancer</h2>
                <span class="count">{{ $freelancers->count() }} akun</span>
            </div>
            <div class="table-scroll">
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($freelancers as $freelancer)
                            <tr>
                                <td class="freelancer-name">{{ $freelancer->name }}</td>
                                <td>{{ $freelancer->email }}</td>
                                <td>
                                    @php
                                        $verificationStatus = $freelancer->verification_status ?? 'pending';
                                    @endphp
                                    <span class="status {{ $verificationStatus }}">
                                        @switch($verificationStatus)
                                            @case('verified')
                                                Terverifikasi
                                                @break
                                            @case('rejected')
                                                Ditolak
                                                @break
                                            @default
                                                Menunggu
                                        @endswitch
                                    </span>
                                </td>
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
                            <tr class="empty-row">
                                <td colspan="4" class="empty">
                                    <strong>Belum ada freelancer</strong>
                                    Akun freelancer yang mendaftar akan muncul di halaman ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
