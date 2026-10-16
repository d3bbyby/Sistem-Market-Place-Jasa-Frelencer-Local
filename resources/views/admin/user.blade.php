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
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
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
            font-size: 28px;
            color: #5c3d2e;
        }

        .subtitle {
            margin: 0;
            font-size: 14px;
            color: #887568;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-add {
            background: #6f4e37;
            color: white;
        }

        .btn-add:hover {
            background: #503725;
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
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
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
            background: #e9dfd5;
            color: #6f4e37;
            font-size: 12px;
            font-weight: bold;
        }

        .actions {
            display: flex;
            gap: 8px;
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

        <!-- TOMBOL BACK -->
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

            <button class="btn btn-add">
                + Tambah User
            </button>
        </div>

        <!-- TABEL USER -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Budi</td>
                        <td>budi123</td>
                        <td>budi@gmail.com</td>
                        <td>
                            <span class="badge">
                                Freelancer
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <button class="btn btn-edit">
                                    Edit
                                </button>

                                <button class="btn btn-delete">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
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
