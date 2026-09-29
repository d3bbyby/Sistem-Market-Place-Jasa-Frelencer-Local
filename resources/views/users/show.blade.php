```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User</title>
</head>
<body>

    <h1>Detail User</h1>

    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Nama:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>

    <br>

    <a href="{{ route('users.index') }}">Kembali</a>

</body>
</html>