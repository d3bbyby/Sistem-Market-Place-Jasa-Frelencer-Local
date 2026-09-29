<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            box-sizing: border-box;
        }

        button, a {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #ffc107;
            color: black;
        }

        a {
            background: #6c757d;
            color: white;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit User</h1>

    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Nama</label>
        <input
            type="text"
            name="name"
            value="{{ old('name', $user->name) }}"
            required
        >

        <label>Email</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            required
        >

        <label>Password Baru</label>
        <input
            type="password"
            name="password"
            placeholder="Kosongkan jika tidak ingin mengubah password"
        >

        <button type="submit">Update</button>

        <a href="{{ route('users.index') }}">Kembali</a>

    </form>

</div>

</body>
</html>