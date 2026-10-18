<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Freelancer - FreelanceHub</title>

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

        /* NAVBAR */
        .navbar {
            min-height: 75px;
            background: white;
            border-bottom: 1px solid #E7E1F4;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 60px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #7047EB;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #625976;
            font-size: 15px;
            transition: 0.2s;
        }

        .nav-menu a:hover {
            color: #7047EB;
        }

        .btn-dashboard {
            background: #7047EB;
            color: white !important;
            padding: 11px 20px;
            border-radius: 8px;
        }

        .btn-dashboard:hover {
            background: #5030B5;
        }

        /* CONTENT */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 45px 0;
        }

        .page-title {
            margin-bottom: 25px;
        }

        .page-title h1 {
            font-size: 32px;
            color: #30264B;
            margin-bottom: 8px;
        }

        .page-title p {
            color: #837B99;
            font-size: 15px;
        }

        /* SEARCH */
        .search-box {
            background: white;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #E7E1F4;
            box-shadow: 0 5px 20px rgba(80, 48, 181, 0.05);
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 12px;
        }

        .search-input {
            flex: 1;
            padding: 14px 16px;
            border: 1px solid #DCD4EF;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            color: #30264B;
            background: #FFFEFF;
        }

        .search-input::placeholder {
            color: #A39BB6;
        }

        .search-input:focus {
            border-color: #7047EB;
            box-shadow: 0 0 0 3px rgba(112, 71, 235, 0.1);
        }

        .search-button {
            padding: 14px 25px;
            border: none;
            border-radius: 8px;
            background: #7047EB;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .search-button:hover {
            background: #5030B5;
        }

        /* HASIL */
        .result-title {
            font-size: 20px;
            margin-bottom: 18px;
            color: #30264B;
        }

        .freelancer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        /* CARD */
        .freelancer-card {
            background: white;
            border: 1px solid #E7E1F4;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(80, 48, 181, 0.05);
            transition: 0.2s;
        }

        .freelancer-card:hover {
            transform: translateY(-3px);
            border-color: #D4C7FF;
            box-shadow: 0 8px 25px rgba(80, 48, 181, 0.11);
        }

        /* FOTO PROFIL */
        .profile-phot {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: #EDE7FF;
            color: #7047EB;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .freelancer-card h3 {
            font-size: 18px;
            margin-bottom: 7px;
            color: #30264B;
        }

        .role {
            color: #7047EB;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .email {
            font-size: 13px;
            color: #837B99;
            margin-bottom: 20px;
            overflow-wrap: anywhere;
        }

        .btn-lihat {
            display: block;
            text-align: center;
            text-decoration: none;
            padding: 11px;
            border-radius: 8px;
            border: 1px solid #7047EB;
            color: #7047EB;
            font-weight: bold;
            font-size: 14px;
            transition: 0.2s;
        }

        .btn-lihat:hover {
            background: #7047EB;
            color: white;
        }

        /* TIDAK ADA HASIL */
        .empty {
            background: white;
            border: 1px solid #E7E1F4;
            border-radius: 15px;
            padding: 50px;
            text-align: center;
            color: #837B99;
        }

        .empty h3 {
            color: #30264B;
        }

        /* RESPONSIVE */
        @media (max-width: 900px) {
            .freelancer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 0 20px;
            }

            .logo {
                font-size: 21px;
            }

            .nav-menu {
                gap: 15px;
            }

            .container {
                width: 92%;
            }

            .search-form {
                flex-direction: column;
            }

            .freelancer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo">
            FreelanceHub
        </div>

        <div class="nav-menu">
            <a href="/">
                Beranda
            </a>

            <a href="/client/dashboard" class="btn-dashboard">
                Dashboard
            </a>
        </div>
    </nav>


    <!-- CONTENT -->
    <div class="container">

        <div class="page-title">
            <h1>Cari Freelancer</h1>
            <p>
                Temukan freelancer sesuai kebutuhanmu.
            </p>
        </div>


        <!-- SEARCH BOX -->
        <div class="search-box">
            <form
                action="/client/jasa"
                method="GET"
                class="search-form"
            >
                <input
                    type="text"
                    name="q"
                    class="search-input"
                    placeholder="Cari nama freelancer..."
                    value="{{ $query ?? '' }}"
                >

                <button
                    type="submit"
                    class="search-button"
                >
                    Cari
                </button>
            </form>
        </div>


        <!-- HASIL -->
        @if ($query)
            <h2 class="result-title">
                Hasil pencarian: "{{ $query }}"
            </h2>
        @else
            <h2 class="result-title">
                Freelancer Tersedia
            </h2>
        @endif


        @if ($freelancers->count() > 0)

            <div class="freelancer-grid">

                @foreach ($freelancers as $freelancer)

                    <div class="freelancer-card">

                        <div class="profile-phot">
                            {{ strtoupper(substr($freelancer->name, 0, 1)) }}
                        </div>

                        <h3>
                            {{ $freelancer->name }}
                        </h3>

                        <div class="role">
                            Freelancer
                        </div>

                        <div class="email">
                            {{ $freelancer->email }}
                        </div>

                        @foreach ($freelancer->services as $service)
                            <div style="border-top: 1px solid #E7E1F4; padding: 16px 0;">
                                <h4 style="margin-bottom: 7px; color: #30264B;">
                                    {{ $service->title }}
                                </h4>
                                <p style="font-size: 13px; color: #837B99; margin-bottom: 8px;">
                                    {{ $service->category?->category_name ?? 'Tanpa kategori' }}
                                </p>
                                <p style="font-weight: bold; color: #7047EB; margin-bottom: 12px;">
                                    Rp{{ number_format((float) $service->price, 0, ',', '.') }}
                                </p>
                                <a href="{{ route('client.orders.service', $service) }}" class="btn-lihat">
                                    Detail dan Pesan
                                </a>
                            </div>
                        @endforeach

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty">
                <h3>
                    Freelancer tidak ditemukan
                </h3>

                <p style="margin-top: 10px;">
                    Coba gunakan kata kunci lain.
                </p>
            </div>

        @endif

    </div>

</body>
</html>